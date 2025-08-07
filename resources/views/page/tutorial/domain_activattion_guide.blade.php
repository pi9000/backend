@extends('layouts.main')
@section('panel')
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col">

                <div>
                    <p>Please access Website - <b>DOMAIN SETTINGS</b>.</p>
                    <p>The goal is to activate the domain directly, get NS, redirect, purge cache, ban
                        IP directly from the agent side.</p>
                    <p>The steps are as follows:</p>
                    <ol>
                        <li>Get Name Server automatically after domain input</li>
                        <span>
                            <div class="img_class">
                                <img src="{{ asset('assets/images/Tutorials/domain_activation_2.png?') }}" height="100" tabindex="0">
                            </div>
                        </span>
                        <li>The system gives NS to point.</li>
                        <span>
                            <div class="img_class">
                                <img src="{{ asset('assets/images/Tutorials/domain_activation_1.png?') }}" height="100" tabindex="0">
                            </div>
                        </span>
                        <li>Once finished, the status changes to "ACTIVE", then wait around 15-30
                            minutes for the domain to be activated.</li>
                        <li>You can set force www, non www, redirection from this menu.</li>
                        <span>
                            <div class="img_class">
                                <img src="{{ asset('assets/images/Tutorials/domain_activation_3.png?') }}" height="100" tabindex="0">
                            </div>
                        </span>
                        <li>You can also verify this domain in GSC, using TXT record, simply add the
                            code to the menu inside domain settings.</li>
                    </ol>




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
