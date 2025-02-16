 <option value="">Select District</option>
 @if($districts->isNotEmpty())
    @foreach($districts as $district)
        <option value="{{ $district->id }}" @if($district_id == $district->id) {{ "selected='selected'" }} @endif >
            {{  $district->district_name }}
        </option>
    @endforeach
 @endif