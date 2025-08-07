@extends('layouts.main')
@section('panel')
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col">

                <div>
                    <h5>What to do before upload your banner images</h5>
                    <h6>Use Webp format</h6>
                    <ul>
                        <li>webp images are smaller in size and can improve page speed</li>
                        <li>Use Squoosh so that able to compare with original source for any blurness.
                        </li>
                        <li>Images play a huge role in website, any blur image will have large affect on
                            website visual.</li>
                    </ul>

                    <h5>Converting images to .webp using Squoosh</h5>
                    <ul>
                        <li><a href="https://squoosh.app/" target="_blank">https://squoosh.app/</a></li>
                        <li>Must use Highest quality image source (either lossless PNG or High quality
                            JPG)</li>
                        <li>On Squoosh, select "Webp" format and set "Effort" to highest, 6</li>
                        <li>For transparent background images, tick "Lossless" and "Preserve Transparent
                            Data"</li>
                    </ul>

                    <h4>For Rereference check the below image:</h4>


                    <div class="img_class">
                        <img src="{{ asset('assets/images/img_guide.png?') }}" height="100"
                            tabindex="0">
                        <img src="{{ asset('https://ams-admin.net/assets/images/img_guide_1.png?') }}" height="100"
                            tabindex="0" style="padding-left: 8px">
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
