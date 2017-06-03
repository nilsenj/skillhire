<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * @var Contact
     */
    private $contacts;

    public function __construct(Contact $contacts)
    {
        $this->contacts = $contacts;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $user = $request->user();
        return response()->json($user->contacts, 200);
    }

    /**
     * TODO implement form request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        try {
            $data = $request->all();
            $user = $request->user();
            $formData = [
                'skype' => !empty($data['skype']) ? $data['skype'] : '',
                'mobile' => !empty($data['mobile']) ? $data['mobile'] : '',
                'experience' => !empty($data['experience']) ? $data['experience'] : '',
                'telegram' => !empty($data['telegram']) ? $data['telegram'] : '',
                'github' => !empty($data['github']) ? $data['github'] : '',
                'linkedin' => !empty($data['linkedin']) ? $data['linkedin'] : '',
                'resume' => !empty($data['resume']) ? $data['resume'] : '',
                'fullname' => !empty($data['fullname']) ? $data['fullname'] : '',
                'email' => !empty($data['email']) ? $data['email'] : ''
            ];

            $contacts = $user->contacts->update($formData);

            return response()->json(['data' => $contacts], 200);
        } catch (\Throwable $exception) {
            return response()->json(['data' => 'Error appeared', 'error' => $exception->getMessage()], $exception->getCode());
        }
    }

    /**
     * TODO implement form request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        try {
            $data = $request->all();
            $user = $request->user();
            $user->contacts->delete();

            return response()->json(['data' => 'Contact Deleted'], 200);
        } catch (\Throwable $exception) {
            return response()->json(['data' => 'Error appeared', 'error' => $exception->getMessage()], $exception->getCode());
        }
    }
}
