<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" placeholder="Name" name="name"
        value="{{ isset($user) ? $user->name : '' }}">
    @if ($errors->has('name'))
        <p class="text-danger">{{ $errors->first('name') }}</p>
    @endif
</div>
<div class="form-group">
    <label for="email">Email</label>
    <input type="text" class="form-control" placeholder="Name" name="email"
        value="{{ isset($user) ? $user->email : '' }}">
    @if ($errors->has('email'))
        <p class="text-danger">{{ $errors->first('email') }}</p>
    @endif
</div>
<div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" placeholder="Password" name="password" value="">
    @if ($errors->has('password'))
        <p class="text-danger">{{ $errors->first('password') }}</p>
    @endif
</div>

<div class="form-group">
    <label for="user_role">Role</label>
    <select name="user_role" class="form-control" id="user_role" onchange="checkRole()">
        @foreach (App\Models\User::$roles as $key => $role)
            <option value="{{ $key }}" {{ isset($user) ? ($user->user_role == $key ? 'selected' : '') : '' }}>
                {{ $role }}</option>
        @endforeach
    </select>
    @if ($errors->has('user_role'))
        <p class="text-danger">{{ $errors->first('user_role') }}</p>
    @endif
</div>


<div class="form-group">
    <label for="photo">Photo</label>
    @if (isset($user))
        <img src="{{ $user->getFirstMediaUrl() }}" alt="{{ $user->name }}" width="100" height="100">
    @endif
    <input type="file" name="photo" class="form-control">
    @if ($errors->has('photo'))
        <p class="text-danger">{{ $errors->first('photo') }}</p>
    @endif
</div>

<div id="trainer-only" style="display: none;">
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" rows="4" class="form-control">{!! isset($user) ? $user->description : old('description') !!}</textarea>
        @if ($errors->has('description'))
            <p class="text-danger">{{ $errors->first('description') }}</p>
        @endif
    </div>
    <div class="form-group">
        <label for="cost_per_month">Cost Per Month</label>
        <input type="text" class="form-control" placeholder="Cost Per Month" name="cost_per_month"
            value="{{ isset($user) ? $user->cost_per_month : '' }}" class="form-control">
        @if ($errors->has('cost_per_month'))
            <p class="text-danger">{{ $errors->first('cost_per_month') }}</p>
        @endif
    </div>
    <div class="form-group">
        <label for="experience">Experience</label>
        <textarea name="experience" id="experience" rows="4" class="form-control">{!! isset($user) ? $user->experience : old('experience') !!}</textarea>
        @if ($errors->has('experience'))
            <p class="text-danger">{{ $errors->first('experience') }}</p>
        @endif
    </div>
</div>

<script>
    function checkRole() {
        var role = document.getElementById('user_role').value;
        var trainerInfo = document.getElementById('trainer-only');
        if (role == 2) {
            trainerInfo.style.display = "block";
        } else {
            trainerInfo.style.display = "none";
        }
    }

    window.onload = function() {
        checkRole();
    }
</script>
