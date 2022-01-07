@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    Atrosユーザー認証テストページです。
                    <br>
                    ALB+Cognito+EC2(public subnet )+RDS(private subnet)
                    <br>
                    @if (Session::has('sub'))
                        <p>sub:{{ session('sub') }}</p>
                    @endif
                    @if (Session::has('email'))
                        <p>email:{{ session('email') }}</p>
                    @endif
                    @if (Session::has('custom:saas_contractor_m_id'))
                        <p>SaaS契約者ID:{{ session('custom:saas_contractor_m_id') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
