@extends('layouts.main')
@section('panel')
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col">

                <div>
                    <p>Access FUND - WINLOSE REBATE SETTINGS</p>
                    <p>Winlose rebate calculated based on LOSE AMOUNT of members, it has 3 mode to
                        categorize the
                        eligibility of the cashback</p>
                    <p>WINLOSE REBATE MODE - DEFAULT</p>
                    <p>System will calculate based on lose amount by each category during the period
                        example below : member will get cashback of 5% in SLOT if member lose between
                        Monday - Sunday
                        period</p>

                    <div class="img_class">
                        <img src="{{ asset('assets/images/Tutorials/winloss_1.png?') }}"
                            class="image" tabindex="0">
                    </div>

                    <p style="margin-top: 5%;">WINLOSE REBATE MODE - BY WINLOSE LEVEL</p>
                    <p>System calculates per winlose amount reached by member <br>
                        example below :</p>
                    <p>member winlose is 9,000 won’t get cashback</p>
                    <p>member winlose is 15,000 will get cashback of 1% = 150</p>
                    <p>member winlose is 30,000 will get cashback of 3% = 900</p>

                    <div class="img_class">
                        <img src="{{ asset('assets/images/Tutorials/winloss_2.png?') }}"
                            class="image" tabindex="0">
                    </div>

                    <p style="margin-top: 5%;">WINLOSE REBATE MODE - BY TURNOVER</p>
                    <p>System calculates how many times turnover reached by member during all deposit in
                        the period,<br>
                        once eligible then will calculate winlose x % set by admin<br>
                        example below :</p>
                    <p>member total deposit for weekly period : 1,000,000</p>
                    <p>member lose : 800,000</p>
                    <p>member turnover : 900,000</p>
                    <p>result : member wont have cashback , due to he need to have turnover at least
                        1,000,000 to get
                        cashback</p>
                    <p>however if member turnover is 2,500,000 and lose 500,000 during this period, he
                        is eligible to get
                        0,1% cashback</p>

                    <div class="img_class">
                        <img src="{{ asset('assets/images/Tutorials/winloss_3.png?') }}"
                            class="image" tabindex="0">
                    </div>

                    <p style="margin-top: 5%">HOW TO RELEASE WINLOSE REBATE (CASHBACK) TO MEMBER</p>

                    <div class="img_class">
                        <img src="{{ asset('assets/images/Tutorials/winloss_4.png?') }}"
                            class="image" tabindex="0">
                    </div>

                    <p style="margin-top: 5%">HOW TO CHECK IF CERTAIN MEMBER DIDN’T GET CASHBACK?</p>
                    <p>insert member code in the search column, and system will have remark whether not
                        reached <br>
                        incompatible minimum, under promotion, not reach to, etc
                    </p>
                    <div class="img_class">
                        <img src="{{ asset('assets/images/Tutorials/winloss_5.png?') }}"
                            class="image" tabindex="0">
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
