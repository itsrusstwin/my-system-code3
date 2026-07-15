@extends('layouts.public')
@section('title', 'Guides - Iskolar ng Bayan')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-8 grid md:grid-cols-2 gap-6">

    <!-- Left column: Guide steps -->
    <div>
        <div class="border border-gray-300 dark:border-gray-700 rounded-lg overflow-hidden mb-4">
            <div class="bg-white dark:bg-gray-800 px-4 py-2 font-semibold text-gray-800 dark:text-gray-100 border-b dark:border-gray-700">
                Guides
            </div>
        </div>

        <div class="border border-gray-300 dark:border-gray-700 rounded-lg overflow-hidden mb-4">
            <div class="bg-blue-600 text-white px-4 py-2 font-semibold">
                STEP 1
            </div>
            <div class="bg-white dark:bg-gray-800 p-4 text-sm text-gray-700 dark:text-gray-300 space-y-3">
                <p>
                    Register on iskolar.ng.bayan website. Click the <strong>Login\Sign up</strong> above
                    and it will take you to the login page then click <strong>Create new account</strong>,
                    if already have a account just login.
                </p>
                <p class="italic text-gray-500 dark:text-gray-400">
                    Magrehistro sa website na iskolar.ng.bayan. I-click ang <strong>Login/Sign up</strong>
                    sa itaas, at dadalhin ka nito sa login page. Pagkatapos, i-click ang
                    <strong>Create new account</strong> kung wala ka pang account. Kung mayroon ka
                    nang account, mag-login na lamang.
                </p>
            </div>
        </div>

        <div class="border border-gray-300 dark:border-gray-700 rounded-lg overflow-hidden mb-4">
            <div class="bg-blue-600 text-white px-4 py-2 font-semibold">
                STEP 2
            </div>
            <div class="bg-white dark:bg-gray-800 p-4 text-sm text-gray-700 dark:text-gray-300 space-y-3">
                <p>
                    Fill up the scholar profile and upload the <strong>CERTIFIED TRUE COPIES</strong>
                    of the documents required in PDF file.
                </p>
                <p class="italic text-gray-500 dark:text-gray-400">
                    Magfill-up ng scholar profile at i-upload ang mga <strong>CERTIFIED TRUE COPIES</strong>
                    ng mga kinakailangang dokumento na naka-PDF.
                </p>
            </div>
        </div>

        <div class="border border-gray-300 dark:border-gray-700 rounded-lg overflow-hidden mb-4">
            <div class="bg-blue-600 text-white px-4 py-2 font-semibold">
                STEP 3
            </div>
            <div class="bg-white dark:bg-gray-800 p-4 text-sm text-gray-700 dark:text-gray-300 space-y-3">
                <p>
                    Wait for the verification of your submitted requirements. You will be notified
                    through your account status if you are qualified to proceed to the next step.
                </p>
                <p class="italic text-gray-500 dark:text-gray-400">
                    Hintayin ang beripikasyon ng iyong mga isinumiteng requirements. Ikaw ay
                    mapapabatid sa pamamagitan ng iyong account status kung ikaw ay kwalipikado
                    upang magpatuloy sa susunod na hakbang.
                </p>
            </div>
        </div>

        <div class="border border-gray-300 dark:border-gray-700 rounded-lg overflow-hidden">
            <div class="bg-blue-600 text-white px-4 py-2 font-semibold">
                STEP 4
            </div>
            <div class="bg-white dark:bg-gray-800 p-4 text-sm text-gray-700 dark:text-gray-300 space-y-3">
                <p>
                    Once qualified, take the scholarship exam on the scheduled date. Results will
                    be posted on your account.
                </p>
                <p class="italic text-gray-500 dark:text-gray-400">
                    Kapag kwalipikado, kunin ang scholarship exam sa naka-iskedyul na petsa. Ang
                    mga resulta ay ipo-post sa iyong account.
                </p>
            </div>
        </div>
    </div>

    <!-- Right column: Hero image -->
    <div class="relative rounded-lg overflow-hidden min-h-[500px]">
        <div class="absolute inset-0 bg-cover bg-center"
             style="background-image: url('{{ asset('images/login-bg.jpg') }}');">
        </div>
        <div class="absolute inset-0 bg-gradient-to-b from-blue-800/30 to-blue-600/70"></div>

        <div class="relative z-10 h-full flex flex-col justify-start p-6 text-white">
            <h2 class="text-3xl font-extrabold leading-tight">
                ISKOLAR<br>NG BAYAN
            </h2>
        </div>
    </div>

</div>
@endsection 