<?php

namespace App\Http\Livewire;

use App\Models\VaccinationStatus;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
class Report extends Component
{
    const OTP_SEARCH_URL = 'https://tiemchungcovid19.gov.vn/api/vaccination/public/otp-search';

    const VACCINATION_URL = 'https://tiemchungcovid19.gov.vn/api/vaccination/public/patient-vaccinated';

    /** @var string */
    public $fullname;

    /** @var string */
    public $birthday;

    /** @var int */
    public $genderId = 0;

    /** @var string */
    public $personalPhoneNumber;

    // public $identification;

    /** @var string */
    public $otp;

    /**
     * Show OTP input field.
     *
     * @var bool
     */
    public $withOTP = false;

    /** @return array<string, string|string[]> */
    public function rules()
    {
        $rules = [
            'fullname' => 'required|min:2',
            'birthday' => 'required|date|before:today',
            'genderId' => 'required|in:0,1',
            'personalPhoneNumber' => ['required', 'regex:/(84|0[3|5|7|8|9])+([0-9]{8})\b/'],
        ];

        return $this->withOTP
            ? $rules + ['otp' => 'required|numeric|digits:6']
            : $rules;
    }

    /**
     * @psalm-suppress PossiblyUndefinedMethod
     */
    public function submit(): void
    {
        if (! auth()->check()) {
            $this->redirect(route('auth.login'));

            return;
        }

        if ($error = $this->handling()) {
            $this->addError($error[0], $error['1']);
        }
    }

    /**
     * @psalm-suppress PossiblyUndefinedMethod
     *
     * @return array{0: string, 1: string}|false
     */
    protected function handling()
    {
        $data = $this->validate();
        $httpClient = Http::withOptions(['verify' => false]);

        $data['birthday'] = strtotime($data['birthday']) * 1000;

        if (! $this->withOTP) {
            $code = $httpClient->get(self::OTP_SEARCH_URL, $data)->json('code', 0);

            if (false === $this->withOTP = (bool) $code) {
                return ['general', 'Your information does not exist on the system'];
            }
        } else {
            $patientInfo = $httpClient->get(self::VACCINATION_URL, $data)->json('patientInfo', []);

            if ($patientInfo === []) {
                return ['otp', 'The verification code is incorrect'];
            }

            $note = [];
            foreach ($patientInfo['vaccinatedInfoes'] as $info) {
                $note[] = sprintf(
                    '%s (%s)',
                    $info['vaccineName'],
                    (string) \date('d-m-Y', $info['injectionDate'] / 1000),
                );
            }

            VaccinationStatus::updateOrCreate([
                'phone_number' => $patientInfo['personalPhoneNumber'],
            ], [
                'name' => Str::title($patientInfo['fullname']),
                'number_injected' => \count($patientInfo['vaccinatedInfoes']),
                'note' => implode(', ', $note),
                'user_id' => auth()->id(),
                'updated_at' => now(),
            ]);

            $this->redirect(route('home'));
        }

        return false;
    }

    /**
     * Real-time validation.
     *
     * @param  string  $name
     * @return void
     */
    public function updated($name)
    {
        $this->validateOnly($name);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.report');
    }
}
