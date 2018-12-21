<div class="tab-pane fade show active" id="pills-general" role="tabpanel" aria-labelledby="pills-general-tab">
    <form method="post" action="/settings/general/mode">
        @csrf
        <div class="card">
            <div class="row p-4">
                <div class="col-sm-2 text-center">
                    <label for="chk-singleStore">
                        <input type="radio" class="radio" name="mode" value="0" {{auth()->user()->mode ? '' : 'checked'}} checked id="chk-singleStore">
                        <h4>Single Store</h4>
                    </label>
                </div>
                <div class="col-sm-2 text-center">
                    <label for="chk-multiStore">
                        <input type="radio" class="radio" name="mode" value="1" {{auth()->user()->mode ? 'checked' : ''}} id="chk-multiStore">
                        <h4>Multi Store</h4>
                    </label>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
