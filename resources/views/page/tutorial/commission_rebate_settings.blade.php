@extends('layouts.main')
@section('panel')
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col">

                <div>
                    <p>First you need to set the function by accessing FUND - COMISSION REBATE SETTINGS
                        MENU
                    </p>
                    <p>START DATE and END DATE -> to set this settings validity, mostly will check NO
                        EXPIRY BUTTON
                        PAYOUT BY = releasing period, daily period is 12:00 today - 11:59 GMT+8
                        tomorrow, weekly period
                        is Monday 12:00 - next week Monday 11:59 GMT+8

                    </p>

                    <div class="img_class">
                        <img src="{{ asset('assets/images/Tutorials/commission_rebate_1.png?') }}" class="image" style="width: 80%" tabindex="0">

                    </div>

                    <p style="margin-top: 5%;">Rebate is calculated based on TURNOVER from player, and
                        can be set from these 2 options below</p>
                    <p>BY MEMBER LEVEL -> Rebate is calculated based on current MEMBER LEVEL <br><br>
                    </p>


                    <div class="img_class">
                        <img src="{{ asset('assets/images/Tutorials/commission_rebate_2.png?') }}" class="image" style="width: 80%" tabindex="0"> <br><br>
                    </div>

                    <p>eg. Member turnover is 10,000,000,- in SLOT GAMES, according to settings in below
                        rebate will be
                        processed like this :</p>

                    <p>If member level is New Member = 10,000,000 x 0,05% = 5,000 </p>
                    <p>
                        If member level is Regular Member = 10,000,000 x 0,15% = 15,000
                    </p>
                    <p>
                        so on
                    </p>

                    <p>
                        Min Amount = Minimum amount to be dispensed </p>
                    <p>
                        Max Amount = Maximum amount of rebate
                    </p>

                    <p style="margin-top: 5%">
                        From example above, new member WILL NOT receive rebate in SLOT, due to minimum
                        payment set
                        to 6,000 while his eligible rebate is only 5,000
                        For Regular member WILL receive only 10,000 instead of 15,000 due to max amount
                        set to 10,000
                    </p>

                    <p>
                        BY TURNOVER -> Rebate is calculated based on each turnover achieved by player
                    </p>


                    <div class="img_class">
                        <img src="{{ asset('assets/images/Tutorials/commission_rebate_3.png?') }}" class="image" style="width: 80%" tabindex="0"><br>
                    </div>

                    <p>
                        Example as above
                    </p>
                    <p>SLOT settings</p>
                    <p>1,000,000 - 1,999,999 will receive 0,1% rebate</p>
                    <p>
                        2,000,000 - 2,999,999 will receive 0,2% rebate</p>
                    <p>
                        3,000,000 - 3,999,999 will receive 0,3% rebate</p>
                    <p>
                        4,000,000 - 4,999,999 will receive 0,4% rebate</p>
                    <p>
                        5,000,000 - 5,999,999 will receive 0,5% rebate
                    </p>
                    <p>so if a player has turnover of 3,200,000 per weekly then 3,200,000 x 0,3% = 9,600
                    </p>
                    <p style="margin-top: 5%">HOW TO RELEASE COMISSION REBATE TO MEMBER</p>
                    <p>Access FUND - COMISSION REBATE</p>


                    <div class="img_class">
                        <img src="{{ asset('assets/images/Tutorials/commission_rebate_4.png?') }}" class="image" tabindex="0"><br>
                    </div>

                    <p style="margin-top: 5%">HOW TO CHECK IF CERTAIN MEMBER DIDN’T GET REBATE?</p>
                    <p>Case below showing that this member didn’t bet at period of 17 - 24 June 2024 in
                        SLOT categories</p>


                    <div class="img_class">
                        <img src="{{ asset('assets/images/Tutorials/commission_rebate_5.png?') }}" class="image" tabindex="0"><br>
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@push('style')
<style>
    img {
        cursor: pointer;
    }

    img:focus {
        --offset: 20px;
        position: fixed;
        inset: var(--offset);
        object-fit: cover;
        width: calc(70dvw - 2 * var(--offset));
        height: calc(70dvh - 2 * var(--offset));
        box-shadow: 0 0 0 var(--offset) rgba(0, 0, 0, .6);
        z-index: 666;
        cursor: unset;
    }

    .img_class {
        display: inline-flex;
    }

    .img_class(img:focus) {
        height: 100px;
        /* same height of image - just jump content prevent */
    }

</style>
@endpush
