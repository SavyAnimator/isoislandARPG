@extends('account.layout')

@section('account-title') Settings @endsection

@section('account-content')
{!! breadcrumbs(['My Account' => Auth::user()->url, 'Settings' => 'account/settings']) !!}

<h1>Settings</h1>

<div class="card p-3 mb-2">
    <h3>Avatar</h3>
    <div class="text-left"><div class="alert alert-warning">Please note a hard refresh may be required to see your updated avatar. Also please note that uploading a .gif will display a 500 error after; the upload should still work, however.</div></div>
    @if(Auth::user()->isStaff)
        <div class="alert alert-danger">For admins - note that .GIF avatars leave a tmp file in the directory (e.g php2471.tmp). There is an automatic schedule to delete these files.
        </div>
    @endif
    <form enctype="multipart/form-data" action="avatar" method="POST">
        <label>Update Profile Image</label><br>
        <input type="file" name="avatar">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" class="pull-right btn btn-sm btn-primary">
    </form>
</div>
<hr>

{!! Form::close() !!}

<div class="card p-3 mb-2">
    <h3>Profile</h3>
    {!! Form::open(['url' => 'account/profile']) !!}
        <div class="form-group">
            {!! Form::label('text', 'Profile Text') !!}
            {!! Form::textarea('text', Auth::user()->profile->text, ['class' => 'form-control wysiwyg']) !!}
        </div>
        <div class="text-right">
            {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}
</div>

<div class="card p-3 mb-2">
    <h3>Theme</h3>
    <p>Change the way the site looks for you! </p>
    {!! Form::open(['url' => 'account/theme']) !!}
        <div class="form-group row">
            <label class="col-md-3 col-form-label">Base Theme</label>
            <div class="col-md-9">
                {!! Form::select('theme', $themeOptions, Auth::user()->theme_id ? Auth::user()->theme_id : ($defaultTheme ? $defaultTheme->id : 0) , ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label">Decorator Theme {!! add_help('A second complimentary theme that is layered over your base theme, and usually affects only a few pieces of the site.') !!}</label>
            <div class="col-md-9">
                {!! Form::select('decorator_theme', $decoratorThemes, Auth::user()->decorator_theme_id ? Auth::user()->decorator_theme_id : null , ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="text-right">
            {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}
</div>


<div class="card p-3 mb-2">
    <h3>Birthday Publicity</h3>
    {!! Form::open(['url' => 'account/dob']) !!}
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Setting</label>
            <div class="col-md-10">
                {!! Form::select('birthday_setting', ['0' => '0: No one can see your birthday.', '1' => '1: Members can see your day and month.', '2' => '2: Anyone can see your day and month.', '3' => '3: Full date public.'],Auth::user()->settings->birthday_setting, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="text-right">
            {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}
</div>

<div class="card p-3 mb-2">
    <h3>Online Visibility</h3>
    {!! Form::open(['url' => 'account/onl']) !!}
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Setting</label>
            <div class="col-md-10">
                {!! Form::select('online_setting', ['0' => '0: Invisible, only admins will see your online status .', '1' => '1: Online, Anyone can see when you are online.'],Auth::user()->settings->online_setting, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="text-right">
            {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}
</div>

<h3>Links</h3>
<p>Add your username to the forms only. A link will be created automatically.</p>

{!! Form::open(['url' => 'account/socials']) !!}
      <div class="form-group row">
          <label class="col-md-2 col-form-label">Discord</label> <i class="fas fa-question-circle" data-toggle="tooltip" title=" Enter your usename and number code - Example: username#0001 "></i>
          <div class="col-md-9">
              {!! Form::text('disc', Auth::user()->profile->disc, ['class' => 'form-control']) !!}
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">DeviantArt <i class="fas fa-question-circle" data-toggle="tooltip" title=" Enter your username  "></i></label>
          <div class="col-md-9">
              {!! Form::text('devian', Auth::user()->profile->devian, ['class' => 'form-control']) !!}
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">Toyhou.se <i class="fas fa-question-circle" data-toggle="tooltip" title=" Enter your username  "></i></label>
          <div class="col-md-9">
              {!! Form::text('house', Auth::user()->profile->house, ['class' => 'form-control']) !!}
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">Instagram <i class="fas fa-question-circle" data-toggle="tooltip" title=" Enter your username  "></i></label>
          <div class="col-md-9">
              {!! Form::text('insta', Auth::user()->profile->insta, ['class' => 'form-control']) !!}
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">Tumblr <i class="fas fa-question-circle" data-toggle="tooltip" title=" Enter your username  "></i></label>
          <div class="col-md-9">
              {!! Form::text('tumb', Auth::user()->profile->tumb, ['class' => 'form-control']) !!}
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">Bluesky <i class="fas fa-question-circle" data-toggle="tooltip" title=" Enter your username  "></i></label>
        <div class="col-md-9">
            {!! Form::text('bluesk', Auth::user()->profile->bluesk, ['class' => 'form-control']) !!}
        </div>
    </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">Twitter <i class="fas fa-question-circle" data-toggle="tooltip" title=" Enter your username  "></i></label>
          <div class="col-md-9">
              {!! Form::text('twitt', Auth::user()->profile->twitt, ['class' => 'form-control']) !!}
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">YouTube <i class="fas fa-question-circle" data-toggle="tooltip" title=" Enter your username  "></i></label>
          <div class="col-md-9">
              {!! Form::text('youtu', Auth::user()->profile->youtu, ['class' => 'form-control']) !!}
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">NewGrounds <i class="fas fa-question-circle" data-toggle="tooltip" title=" Enter your username  "></i></label>
          <div class="col-md-9">
              {!! Form::text('newgr', Auth::user()->profile->newgr, ['class' => 'form-control']) !!}
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">ArtStation <i class="fas fa-question-circle" data-toggle="tooltip" title=" Enter your username  "></i></label>
          <div class="col-md-9">
              {!! Form::text('artsta', Auth::user()->profile->artsta, ['class' => 'form-control']) !!}
          </div>
      </div>
      <div class="text-right">
          {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
      </div>
{!! Form::close() !!}
<hr>

<div class="card p-3 mb-2">
    <h3>Email Address</h3>
    <p>Changing your email address will require you to re-verify your email address.</p>
    {!! Form::open(['url' => 'account/email']) !!}
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Email Address</label>
            <div class="col-md-10">
                {!! Form::text('email', Auth::user()->email, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="text-right">
            {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}
</div>

<div class="card p-3 mb-2">
    <h3>Change Password</h3>
    {!! Form::open(['url' => 'account/password']) !!}
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Old Password</label>
            <div class="col-md-10">
                {!! Form::password('old_password', ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label">New Password</label>
            <div class="col-md-10">
                {!! Form::password('new_password', ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Confirm New Password</label>
            <div class="col-md-10">
                {!! Form::password('new_password_confirmation', ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="text-right">
            {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
</div>

@endsection
