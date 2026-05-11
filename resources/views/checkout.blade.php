@extends('master')
@section('content')
<section id="index-req-post" class="req__posts__container ">
        <div class="req__posts container">

            <!-- requament post links -->
            <div class="requament__links">
                <div class="req__posts__links">
                    <h1>تعرفه انتخابی</h1>
                    <div class="last__posts__cr">
                        <div class="last__post__text">
                            <h4 class="yl-hover p-2">{{ $plan->title }} {{ $plan->duration }} روزه </h4>
                        </div>
                        <div class="subescriptionPrice" style="margin-top: 1.3rem; margin-bottom: 0 !important;">
                            {{ number_format($plan->price) }} تومان
                        </div>
                    </div>
                </div>

                <a class="contact__us__btn" href="" target="_blank">پرداخت نهایی</a>
            </div>

            <!-- requament text box -->
            <div class="req__posts__text">
                <div class="post__text__cr video__formats">
                    <h1>انتخاب درگاه پرداخت</h1>
                    <div class="form-control-container" style="background: inherit !important;">
                        <form action="{{ route('index.checkout.submit',['plan' => $plan->id]) }}" method="POST" class="checkout-form">
                            @csrf
                            <div class="custom-payments-method">
                                <div class="custom-payments-method-items">
                                    <div class="form-check custom-option custom-option-icon">
                                        <label class="form-check-label custom-option-content" for="zarinpal">
                                        <span class="custom-option-body">
                                            <img src="{{ asset("assets/img/branding/zarinpalico.avif") }}" class="w-px-40 mb-2" alt="wallet">
                                            <span class="custom-option-title mb-2"> زرین پال </span>
                                        </span>
                                        <input name="paymentMethod" class="form-check-input" type="radio" value="zarinpal" id="zarinpal">
                                        </label>
                                    </div>
                                </div>
                                <div class="custom-payments-method-items">
                                    <div class="form-check custom-option custom-option-icon">
                                        <label class="form-check-label custom-option-content" for="mellat">
                                        <span class="custom-option-body">
                                            <img src="{{ asset("assets/img/branding/mellat.png") }}" class="w-px-40 mb-2" alt="wallet">
                                            <span class="custom-option-title mb-2"> بانک ملت </span>
                                        </span>
                                        <input name="paymentMethod" class="form-check-input" type="radio" value="mellat" id="mellat">
                                        </label>
                                    </div>
                                </div>
                                <div class="custom-payments-method-items">
                                    <div class="form-check custom-option custom-option-icon">
                                        <label class="form-check-label custom-option-content" for="irandargah">
                                        <span class="custom-option-body">
                                            <img src="{{ asset("assets/img/branding/logo.1f1748a0.svg") }}" class="w-px-40 mb-2" alt="wallet">
                                            <span class="custom-option-title mb-2"> ایران درگاه </span>
                                        </span>
                                        <input name="paymentMethod" class="form-check-input" type="radio" value="irandargah" id="irandargah">
                                        </label>
                                    </div>
                                </div>
                                <div class="custom-payments-method-items">
                                    <div class="form-check custom-option custom-option-icon">
                                        <label class="form-check-label custom-option-content" for="parspal">
                                        <span class="custom-option-body">
                                            <img src="{{ asset("assets/img/branding/parspal.jpg") }}" class="w-px-40 mb-2" alt="wallet">
                                            <span class="custom-option-title mb-2"> پارس پال </span>
                                        </span>
                                        <input name="paymentMethod" class="form-check-input" type="radio" value="parspal" id="parspal">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- main body end -->
@endsection
@section("js")
<script>
    let submitBtn = document.querySelector(".contact__us__btn");
    let form = document.querySelector(".checkout-form");
    submitBtn.addEventListener("click", function (e){
        e.preventDefault();
        form.submit();
    });
</script>
@endsection