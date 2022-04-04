<?php

namespace App\Http\Livewire;

use App\Models\VaccinationStatus;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

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

    public function submit(): void
    {
        if (auth()->check()) {
            $this->vaccination();

            return;
        }

        $this->addError('general', 'You must login first');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|void
     */
    protected function vaccination()
    {
        $data = $this->validateAndCast();
        $httpClient = Http::withOptions(['verify' => false]);

        if (! $this->withOTP) {
            $code = $httpClient->get(self::OTP_SEARCH_URL, $data)
                ->json('code', 0);

            if (false === $this->withOTP = (bool) $code) {
                $this->addError('general', 'Your information does not exist on the system');
            }

            return;
        }

        $data = $httpClient->get(self::VACCINATION_URL, $data)
            ->json('patientInfo', []);

        if ($data === []) {
            $this->addError('otp', 'The verification code is incorrect');

            return;
        }

        $note = [];
        foreach ($data['vaccinatedInfoes'] as $info) {
            $note[] = sprintf(
                '%s (%s)',
                $info['vaccineName'],
                \date('d-m-Y', $info['injectionDate'] / 1000),
            );
        }

        VaccinationStatus::updateOrCreate([
            'phone_number' => $data['personalPhoneNumber'],
        ], [
            'name' => Str::title($data['fullname']),
            'number_injected' => \count($data['vaccinatedInfoes']),
            'note' => implode(', ', $note),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('home');
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
     * @return array{fullname: string, birthday: int, genderId: string, personalPhoneNumber: string}
     */
    protected function validateAndCast(): array
    {
        /** @var array{fullname: string, birthday: int, genderId: string, personalPhoneNumber: string} */
        $data = $this->validate();
        $data['birthday'] = strtotime((string) $data['birthday']) * 1000;

        return $data;
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function render()
    {
        return view('livewire.report');
    }
}
