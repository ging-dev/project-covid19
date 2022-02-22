<?php

namespace App\Http\Livewire;

use App\Models\VaccinationStatus;
use Illuminate\Http\Client\Response;
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
     * Show OTP input field
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
        $data = $this->validateAndCast();

        $this->vaccination($data);
    }

    /**
     * @param array<string, string> $data
     * @return \Illuminate\Http\RedirectResponse|void
     */
    protected function vaccination($data)
    {
        if (!$this->withOTP) {
            $code = $this->makeRequest(self::OTP_SEARCH_URL, $data)
                ->json('code', 0);

            if (false === $this->withOTP = (bool) $code) {
                $this->addError('general', 'Your information does not exist on the system');
            }

            return;
        }

        $data = $this->makeRequest(self::VACCINATION_URL, $data)
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

        VaccinationStatus::query()->updateOrCreate([
            'phone_number' => $data['personalPhoneNumber'],
        ], [
            'name' => Str::title($data['fullname']),
            'number_injected' => \count($data['vaccinatedInfoes']),
            'note' => implode(', ', $note),
        ]);

        return redirect()->route('home');
    }

    /**
     * @param array<string, string> $query
     */
    protected function makeRequest(string $url, array $query): Response
    {
        return Http::withOptions(['verify' => false])->get($url, $query);
    }

    /**
     * Real-time validation
     *
     * @param string $name
     * @return void
     */
    public function updated($name)
    {
        $this->validateOnly($name);
    }

    /**
     * @return array<string, string>
     */
    protected function validateAndCast(): array
    {
        $data = $this->validate();
        $data['birthday'] = strtotime($data['birthday']) * 1000;

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
