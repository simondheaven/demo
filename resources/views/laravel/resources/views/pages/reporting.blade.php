@extends('layouts.app')

@section('content')




<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
          <div class="panel panel-default">
              <div class="panel-heading custom-heading">
                Reporting
              </div>
              <div class="panel-body custom-body">


                <div style="text-align:center; padding: 1px; display:grid; grid-template-columns: repeat(4,1fr);">
                  <div class=" " style="border: 0px solid #0099A8; padding:1px; border-radius: 11px; padding-bottom:5px;">
                    <legend>Customer Activity</legend>
                    <p><small>
                      Customer by customer chronological list of all communications, bounces, updates and comments.
                    </small></p>
                    {{ Form::open(array('url' => route('report.generate'))) }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="type" value="activity"/>
                    {{ Form::submit('Generate', ['class' => 'btn btn-primary custom-btn-submit', 'onclick' => 'wheel()']) }}
                    {{ Form::close() }}
                  </div>
                  <div class=" " style="border: 0px solid #0099A8; padding:1px; border-radius: 11px; padding-bottom:5px;">
                    <legend>Inline Customer Activity</legend>
                    <p><small>
                      Customer by customer single-line reports of held information and successful communication types & dates.
                    </small></p>
                    {{ Form::open(array('url' => route('report.generate'))) }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="type" value="inline activity"/>
                    {{ Form::submit('Generate', ['class' => 'btn btn-primary custom-btn-submit', 'onclick' => 'wheel()']) }}
                    {{ Form::close() }}
                  </div>
                  <div class=" " style="border: 0px solid #0099A8; padding:1px; border-radius: 11px; padding-bottom:5px;">
                    <legend>Inline Paid Customers</legend>
                    <p><small>
                      Customer by customer single-line reports of paid customers and whether they were paid by bacs or by cheque.
                    </small></p>
                    {{ Form::open(array('url' => route('report.generate'))) }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="type" value="inline paid"/>
                    {{ Form::submit('Generate', ['class' => 'btn btn-primary custom-btn-submit', 'onclick' => 'wheel()']) }}
                    {{ Form::close() }}
                  </div>
                  <div class=" " style="border: 0px dashed #F0F0F0; padding:1px; border-radius: 11px;  padding-bottom:5px;">
                    <legend>All Attempts</legend>
                    <p><small>
                      All held information for customers along with a list of all successful and failed contact attempts.
                    </small></p>
                    {{ Form::open(array('url' => route('report.generate'))) }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="type" value="all attempts"/>
                    {{ Form::submit('Generate', ['class' => 'btn btn-primary custom-btn-submit', 'onclick' => 'wheel()']) }}
                    {{ Form::close() }}
                  </div>
                  <div class=" " style="border: 0px solid #0099A8; padding:1px; border-radius: 11px;  padding-bottom:5px;">
                    <legend>Paid Customers</legend>
                    <p><small>
                      Held information and comments for all paid customers sorted by uploaded cheque and bacs report files.
                    </small></p>
                    {{ Form::open(array('url' => route('report.generate'))) }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="type" value="paid"/>
                    {{ Form::submit('Generate', ['class' => 'btn btn-primary custom-btn-submit', 'onclick' => 'wheel()']) }}
                    {{ Form::close() }}
                  </div>
                  <div class=" " style="border: 0px solid #0099A8; padding:1px; border-radius: 11px;  padding-bottom:5px;">
                    <legend>Unpaid Customers</legend>
                    <p><small>
                      All held information and comments for all unpaid customers.
                    </small></p>
                    {{ Form::open(array('url' => route('report.generate'))) }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="type" value="unpaid"/>
                    {{ Form::submit('Generate', ['class' => 'btn btn-primary custom-btn-submit', 'onclick' => 'wheel()']) }}
                    {{ Form::close() }}
                  </div>
                  <div class=" " style="border: 0px solid #0099A8; padding:1px; border-radius: 11px; padding-bottom:5px;">
                    <legend>Incomplete Customers</legend>
                    <p><small>
                      All held information and comments for customers with less than five successful attempts.
                    </small></p>
                    {{ Form::open(array('url' => route('report.generate'))) }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="type" value="incomplete"/>
                    {{ Form::submit('Generate', ['class' => 'btn btn-primary custom-btn-submit', 'onclick' => 'wheel()']) }}
                    {{ Form::close() }}
                  </div>
                  <div class=" " style="border: 0px dashed #0099A8; padding:1px; border-radius: 11px;  padding-bottom:5px;">
                    <legend>Cheques to Void</legend>
                    <p><small>
                      Report containing a list of obsolete cheque numbers to be voided.
                    </small></p>
                    {{ Form::open(array('url' => route('report.generate'))) }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="type" value="voids"/>
                    {{ Form::submit('Generate', ['class' => 'btn btn-primary custom-btn-submit', 'onclick' => 'wheel()']) }}
                    {{ Form::close() }}
                  </div>
                  <div class=" " style="border: 0px dashed #0099A8; padding:1px; border-radius: 11px;  padding-bottom:5px;">
                    <legend>Cashed Deceased</legend>
                    <p><small>
                      All held information and comments for deceased customers who have been paid.
                    </small></p>
                    {{ Form::open(array('url' => route('report.generate'))) }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="type" value="cashed deceased"/>
                    {{ Form::submit('Generate', ['class' => 'btn btn-primary custom-btn-submit', 'onclick' => 'wheel()']) }}
                    {{ Form::close() }}
                  </div>
                  <div class=" " style="border: 0px dashed #F0F0F0; padding:1px; border-radius: 11px;  padding-bottom:5px;">
                    <legend>Cashed Goneaways</legend>
                    <p><small>
                      All held information and comments for paid customers who were initially marked as goneaway.
                    </small></p>
                    {{ Form::open(array('url' => route('report.generate'))) }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="type" value="cashed goneaway"/>
                    {{ Form::submit('Generate', ['class' => 'btn btn-primary custom-btn-submit', 'onclick' => 'wheel()']) }}
                    {{ Form::close() }}
                  </div>
                  <div class=" " style="border: 0px dashed #F0F0F0; padding:1px; border-radius: 11px;  padding-bottom:5px;">
                    <legend>Cashed Verified</legend>
                    <p><small>
                      All held information and comments for paid customers who were initially marked as verified.
                    </small></p>
                    {{ Form::open(array('url' => route('report.generate'))) }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="type" value="cashed verified"/>
                    {{ Form::submit('Generate', ['class' => 'btn btn-primary custom-btn-submit', 'onclick' => 'wheel()']) }}
                    {{ Form::close() }}
                  </div>

                </div>


              </div>
            </div>
        </div>
    </div>
</div>

@endsection
