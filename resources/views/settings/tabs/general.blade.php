<div class="tab-pane fade" id="pills-general" role="tabpanel" aria-labelledby="pills-general-tab">
    <!-- <form method="post" action="/settings/general/mode">
        @csrf
        <div class="card">
            <div class="card-header">
                Store Mode
            </div>
            <div class="row p-4">
                <div class="col-sm-3 text-center">
                    <label class="mr-4" for="chk-singleStore">
                        <input type="radio" class="radio" name="mode" value="0" {{auth()->user()->mode ? '' : 'checked'}} checked id="chk-singleStore">
                        <h4>Single Store</h4>
                    </label>
                </div>
                <div class="col-sm-3 text-center">
                    <label class="mr-4" for="chk-multiStore">
                        <input type="radio" class="radio" name="mode" value="1" {{auth()->user()->mode ? 'checked' : ''}} id="chk-multiStore">
                        <h4>Multi Store</h4>
                    </label>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form> -->

    <form method="post" action="/settings/general/report">
        @csrf
        <div class="card mt-4">
            <div class="card-header">
                Report Frequency
            </div>
            <div class="card-body">
                <label class="mr-4" for="chkWeekly">
                    <input type="checkbox" name="weekly" {{isset(auth()->user()->reportfrequency) && auth()->user()->reportfrequency->weekly ? 'checked' : ''}} value="1" id="chkWeekly"> Weekly
                </label>
                <label class="mr-4" for="chkMonthly">
                    <input type="checkbox" name="monthly" {{isset(auth()->user()->reportfrequency) && auth()->user()->reportfrequency->monthly ? 'checked' : ''}} value="1" id="chkMonthly"> Monthly
                </label>
                <label class="mr-4" for="chkQuarterly">
                    <input type="checkbox" name="quarterly" {{isset(auth()->user()->reportfrequency) && auth()->user()->reportfrequency->quarterly ? 'checked' : ''}} value="1" id="chkQuarterly"> Quarterly
                </label>
                <label class="mr-4" for="chkSixMonth">
                    <input type="checkbox" name="sixmonth" {{isset(auth()->user()->reportfrequency) && auth()->user()->reportfrequency->sixmonth ? 'checked' : ''}} value="1" id="chkSixMonth"> Six Month
                </label>
                <label class="mr-4" for="chkYearly">
                    <input type="checkbox" name="yearly" {{isset(auth()->user()->reportfrequency) && auth()->user()->reportfrequency->yearly ? 'checked' : ''}} value="1" id="chkYearly"> Yearly
                </label>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
