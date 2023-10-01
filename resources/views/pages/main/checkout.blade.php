@extends("layouts.layout")
@section("content")
  <!-- Content -->
  <div class="page-content bg-white">
  
    <div class="page-content bg-white">
        <div class="page-banner contact-page section-sp2">
            <div class="more-container">
                <form class="contact-bx" action="{{ route("purchase_subscription") }}" method="POST">
                    @csrf
                <div class="row">
					<div class="col-lg-8 col-md-12">
							<div class="heading-bx left">
								<h2 class="title-head">Checkout</h2>
                                <input name="id" type="hidden" 
                                 class="form-control valid-character" value="{{ $sub->ID }}" />
							</div>
                            <div class="row m-t30">
                                <div class="col-lg-6">
                                    <h4>Billing address</h4>
                                    <label class="col-form-label">Country</label>
                                 
                                    <select class="form-select country-select" name="country[]" id="data-select">
                                        <option value="0" selected>Select from below</option>
                                        @foreach ($addresar as $d)
                                                <option value="{{ $d->name }}"><i class="fa fa-clock-o"></i>{{ $d->name }}</option>
                                        @endforeach
                                      </select>
                                      @error('country.*')
                                      <div class="alert alert-danger">
                                          {{$message}}
                                      </div>
                                     @enderror
                                </div>
                            </div>
                            <div class="row m-t30">
                                <div class="col-lg-12">
                                    <h4>Payment method</h4>
                                    <div class="ttr-accordion m-b30 faq-bx" id="accordion1">
                                        <div class="panel">
                                            <div class="acod-head">
                                                <h6 class="acod-title"> 
                                                    <a data-toggle="collapse" href="#faq1" class="collapsed" data-parent="#faq1">
                                                        <div class="">
                                                            <img src="{{ asset('assets/images/icon/card.png') }}" class="" width="30" height="11"/>
                                                              <span class="ud-heading-md">
                                                                Credit / Debit Card 
                                                             </span>
                                                             <div style="float: right">
                                                                 <img src="{{ asset('assets/images/icon/american_express.png') }}" class="" width="30" height="11"/>
                                                                 <img src="{{ asset('assets/images/icon/Visa.png') }}" class="" width="30" height="11"/>
                                                                 <img src="{{ asset('assets/images/icon/mastercard.png') }}" class="" width="30" height="11"/>
                                                             </div>
                                                           
                                                        </div>
                                                   
                                                </a> </h6>
                                            </div>
                                            <div id="faq1" class="acod-body collapse show">
                                                <div class="acod-content">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label>Name or Card</label>
                                                                    <div class="input-group">
                                                                        <input name="card_name" type="text" 
                                                                        required class="form-control " placeholder="Name or Card">
                                                                        @error('card_name')
                                                                        <div class="alert alert-danger">
                                                                            {{$message}}
                                                                        </div>
                                                                       @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label>Card Number</label>
                                                                    <div class="input-group">
                                                                        <input name="card_number" type="text" 
                                                                        required class="form-control " placeholder="1234-5678-9012-3456">
                                                                        @error('card_number')
                                                                        <div class="alert alert-danger">
                                                                            {{$message}}
                                                                        </div>
                                                                       @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Expiry date</label>
                                                                    <div class="input-group">
                                                                        <input name="expiry_date" type="text"
                                                                         required class="form-control "  placeholder="MM/YY">
                                                                         @error('expiry_date')
                                                                         <div class="alert alert-danger">
                                                                             {{$message}}
                                                                         </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>CVC/CVV</label>
                                                                    <div class="input-group">
                                                                        <input name="cvc" type="text" 
                                                                        required class="form-control " placeholder="CVC">
                                                                        @error('cvc')
                                                                        <div class="alert alert-danger">
                                                                            {{$message}}
                                                                        </div>
                                                                       @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel">
                                            <div class="acod-head">
                                                <h6 class="acod-title"> 
                                                    <a data-toggle="collapse" href="#faq2" class="collapsed" data-parent="#faq2">
                                                        <div>
                                                            <img src="{{ asset('assets/images/icon/paypal.png') }}" class="" width="30" height="11"/>
                                                            <span class="ud-heading-md">
                                                                PayPal
                                                             </span>
                                                        </div>
                                                    </a> </h6>
                                            </div>
                                            <div id="faq2" class="acod-body collapse">
                                                <div class="acod-content">
                                                    There is currently not setting input for this functionality.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-t30">
                                <div class="col-lg-6">
                                    <h4>Details</h4>
                                    <div style="display:flex;justify-content:space-between">
                                        <p>Subscription payment:</p>
                                        <span>$ {{ $sub->price }}</span>
                                    </div>
                                </div>
                            </div>
						
						
					</div>
                    <div class="col-lg-4 col-md-12 m-b30">
						<div class="contact-info-bx">
							<h2 class="m-b10 title-head">Summary</h2>
							<div style="display:flex; justify-content:space-between">
                                <p>Price:</p>
                                <span>$ {{ $sub->price }}</span>
                            </div>
							<div class="widget widget_getintuch" style="display: flex; flex-direction:column">	
								<label for="" class="col-form-label" style="font-size: 10px">By completing your purchase you agree to these Terms of Service.</label>
                                <button  type="submit" class="ud-btn ud-btn-primary">Complete Checkout</button>
                                <label for="" class="col-form-label" style="font-size: 10px">30-Day Money-Back Guarantee</label>
							</div>
						</div>
					</div>
				</div>
            </form>
            </div>
		</div>
        <!-- inner page banner END -->
    </div>
</div>
<!-- Content END-->
@endsection