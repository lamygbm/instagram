@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">créer un post</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="caption" >caption</label>
                            <input id="caption" type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}"  autocomplete="caption" autofocus>

                                @error('caption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                         </div>
                    
                <div class="form-group">
                    <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input @error ('image') is-invalid @enderror" id="validatedInputGroupCustomFile" >
                        <label class="custom-file-label" for="validatedInputGroupCustomFile">Choisir une image</label>
                               @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                    </div>
                </div>
                        
                                <button type="submit" class="btn btn-primary">
                                   créer mon post
                                </button>
                            </div>
                </div>
                    </form>
             </div>
          </div>
        </div>
    </div>
 </div>