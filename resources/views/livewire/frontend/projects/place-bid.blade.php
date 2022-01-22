<div class="modal" id="applyjob" wire:ignore.self>
    <div class="modal-dialog modal-lg">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="text-light text-center">Place a Bid</h3>
            </div>
            <form wire:submit.prevent='place_bid'>
            <div class="modal-body">
                {{--  <div class="notice">
                    <span class="text-danger">Note:</span><span>Freelancer project fee will only be changed when you get awarded and accept the project.</span>
                </div>  --}}
                <div class="innerbody">
                    <h3>Bids :</h3>
                    <div class="paydel">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <h4>Paid to you :</h4>
                                  <div class="place-bid-form">

                                      <div class="form-row align-items-center">
                                        <div class="col-auto">
                                          <label class="sr-only" for="inlineFormInputGroup">Username</label>
                                          <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                              <div class="input-group-text">$</div>
                                            </div>
                                            <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="{{ $project->min_price }}" value="{{ old('bid') }}" wire:model='bid'>
                                            <div class="input-group-prepend">
                                              <div class="input-group-text">USD</div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>

                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <h4>Delivery in :</h4>
                                <div class="place-bid-form delivery">

                                  <div class="form-row align-items-center">
                                    <div class="col-auto">
                                      <label class="sr-only" for="inlineFormInputGroup">Username</label>
                                      <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">Days</div>
                                        </div>
                                        <select id="exampleFormControlSelect1" class="form-control" wire:model='delivery'>
                                        <option>10</option>
                                        <option>20</option>
                                        <option>30</option>
                                        <option>40</option>
                                      </select>
                                      </div>
                                    </div>
                                  </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <h4>Detail  :</h4>
                                <div class="place-bid-form delivery">
                                 <div class="form-row align-items-center">
                                    <div class="col-auto w-100">

                                        <div class="form-group">
                                            <textarea class="form-control" rows="5" placeholder="Something about yourself.." wire:model='detail'>{{ old('detail') }}</textarea>
                                        </div>
                                    </div>
                                  </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    {{--  <p>Freelancer Project Fee :<b> $55.56 USD</b></p>
                    <p>Your Bid : <b>$555.56 USD</b></p>  --}}
                </div>
                {{--  <div class="beatcompitation">
                    <h3>Super charge your bid and beat your competition!</h3>
                </div>
                <div class="sponser">
                    <p><i class="la la-check"></i>Sponser my bid! Be the first did seen by the employer.</p>
                    <h2>$3.99 USD</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer rhoncus mauris sit amet leo feugiat mollis. Nam pharetra velit in viverra finibus.</p>
                </div>  --}}
            </div>
            <div class="modal-footer">
                @if ($btn_disable)
                <button class="place-bid-btn" type="button" disabled>Loading..</button>
                @else
                <button class="place-bid-btn" type="submit">Place a Bid</button>
                @endif

                {{--  <button>Cancel</button>  --}}
            </div>
            </form>
        </div>
    </div>
</div>
