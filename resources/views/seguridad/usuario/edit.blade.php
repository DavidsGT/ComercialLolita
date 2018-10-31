@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
		<h3>Editar Usuario: {{ $usuario->name}} </h3>
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
			@foreach($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
			</ul>
		</div>
		@endif

		{!! Form::model($usuario,['method'=>'PATCH','route'=>['seguridad.usuario.update',$usuario->id]]) !!}
			{{Form::token()}}
			         <div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
                            <div class="form-group">
                     <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>

                          
                                <input id="name" type="text" class="form-control" name="name" value="{{$usuario->name}}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
                            <div class="form-group">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                           
                                <input id="email" type="email" class="form-control" name="email" value="{{$usuario->email}}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
                            <div class="form-group">
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                             <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                             </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar Password</label>

                            <div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
                            <div class="form-group">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         </div>
                         <div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
                             <div class="form-group">
                                <label for="cajero">Codigo Para Cajero</label>
                                <input type="number" name="cajero" value="{{$usuario->cajero}}" class="form-control" placeholder="Solo Para Cajeros....">        
                            </div>
                        </div>
                           <div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
                            <div class="form-group">
                                <label for="tipo">Tipo Perfil</label>
                                <select name="tipo" id="tipo" class="form-control selectpicker" data-live-search="true">
                                  
                                @foreach($perfil as $per)
                                        <option value="{{$per->idperfil}}_{{$per->detalle}}">
                                        {{$per->detalle}}
                                    </option>
                                @endforeach
                                </select>
                            </div>
                        </div>
		              <div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
                            <div class="form-group">
                			<button class="btn btn-primary" type="submit">Guardar</button>
                		<button class="btn btn-danger" onclick="history.back()" type="reset">Salir</button>
			                 </div>
                        </div>
		{!! Form::close()!!}
	</div>
	
</div>
@endsection