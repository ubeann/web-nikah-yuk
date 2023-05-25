<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller {
    public function landing(Request $request) {
        // Reviews data
        $reviews = [
            [
                'name' => 'Raffi',
                'client_type' => 'Happy Clients',
                'content' => 'Layanan Nikah Yuk benar-benar fantastis! Mereka membuat pernikahan kami menjadi momen yang tak terlupakan. Semua detail ditangani dengan sempurna dan penuh gaya. Tim mereka sangat profesional dan penuh energi. Terima kasih Nikah Yuk!'
            ],
            [
                'name' => 'Sarah',
                'client_type' => 'Satisfied Customers',
                'content' => 'Gak nyangka deh, layanan Nikah Yuk ini bener-bener oke banget! Mereka ngasih kita pengalaman pernikahan yang trendy dan gaul. Semua tamu kita seneng banget sama acara yang mereka atur. Mantap!'
            ],
            [
                'name' => 'John',
                'client_type' => 'Happy Couples',
                'content' => 'Nikah Yuk emang juara! Mereka ngatur acara pernikahan kita dengan penuh keceriaan dan style. Mulai dari dekorasi sampe hiburan, semuanya mantap abis. Pernikahan kita jadi bikin banyak orang iri nih!'
            ],
            [
                'name' => 'Linda',
                'client_type' => 'Delighted Guests',
                'content' => 'Wow, Nikah Yuk bener-bener keren! Acara pernikahan teman kita ditangani dengan profesional dan penuh kejutan. Mereka ngasih kita pengalaman unik dan seru banget. Ga nyesel deh dateng ke pernikahan yang mereka atur!'
            ],
            [
                'name' => 'Alex',
                'client_type' => 'Thrilled Customers',
                'content' => 'Percayain aja deh sama Nikah Yuk, mereka bener-bener keren! Pernikahan kita jadi kece banget berkat layanan mereka. Semuanya diatur dengan penuh gaya dan kekinian. Acara yang bikin hati kita meleleh, pokoknya top!'
            ],
            [
                'name' => 'Emily',
                'client_type' => 'Happy Brides',
                'content' => 'Makasih Nikah Yuk buat pernikahan impian kita! Mereka bener-bener mengerti apa yang kita mau dan ngasih sentuhan kreatif yang memukau. Semua tamu kita sampe bilang ini pernikahan paling keren yang pernah mereka datengin. Luar biasa!'
            ],
            [
                'name' => 'David',
                'client_type' => 'Excited Grooms',
                'content' => 'Nikah Yuk emang jagoan! Mereka ngatur pernikahan kita dengan penuh semangat dan keahlian. Semua yang kita pengenin ada di acara ini, dari dekorasi sampe hiburan. Keren banget! Gak ada yang bisa ngalahin!'
            ]
        ];

        // Return view
        return view('client.landing', compact('reviews'));
    }

    public function loginForm() {
        // TODO: Change route to dashboard if user already logged in
        // Check Auth
        if (auth()->guard('user')->check()) {
            return redirect()->route('client.dummy');
        }

        // Return view
        return view('client.login');
    }

    public function registerForm() {
        // TODO: Change route to dashboard if user already logged in
        // Check Auth
        if (auth()->guard('user')->check()) {
            return redirect()->route('client.dummy');
        }

        // Return view
        return view('client.register');
    }
}
