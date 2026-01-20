@extends('layouts.admin.page')

@section('content')
    <div class="form-loggedin terms-form">
        <!---form element-->
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-7">
                    <div class="card">

                        <div class="card-header">Terms of Service</div>

                        <div class="card-body">

                            {!! Form::model(array($seller), ['action' => 'Seller\SellerController@update']) !!}

                            <div class="form-group row">
                                <div class="container">
                                    <!-- <div class="row">
                                        <div class="col-md-10">
                                            <label>I confirm there are no other bank accounts associated with this company other than the ones for which bank statements have been uploaded.<span class="required"></span></label>

                                            {!! Form::checkbox('no_other_bank',1,false,['class' => 'float-right']) !!}
                                            <div>
                                                <span class="error_input">
                                                    <strong>{{ $errors->first('no_other_bank') }}</strong>
                                                </span>
                                            </div>
                                        </div>

                                    </div> -->

                                    <div class="row">
                                        <div class="col-md-10">
                                            <label>I have read and agree to the Terms and Conditions of service.<span class="required"></span></label>
            
                                            <!-- {!! Form::label('agree','I have read and agree to the Terms and Conditions of service and the Agency Agreement.') !!} -->
                                            

                                            {!! Form::checkbox('agree',1,false,['class' => 'float-right']) !!}
                                            <div> <span class="error_input">
                                                <strong>{{ $errors->first('agree') }}</strong>
                                           </span></div>

                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col">

                                            <!-- <a href="#" data-toggle="modal" data-target="#modelId">Read Terms and Conditions and Agency Agreement.</a> -->
                                            <a href="http://3.10.169.59/funding_joint/public/terms" target="_blank">Read the Terms and Conditions.</a>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-primary btn-danger">
                                                {{ __('Complete Registration',['class' => 'btn btn-primary btn-danger']) }}
                                            </button>
                                        </div>
                                    </div>


                                </div>
                                <!--end container-->


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelTitleId">Read our terms before you agree!</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body" style=" height: 300px; overflow-y: scroll;">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet aspernatur at, commodi doloribus
                    ipsam quisquam quos repudiandae voluptate! Ab ad at dicta distinctio excepturi fugit ipsa maiores
                    maxime obcaecati placeat?
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, in, reprehenderit! Commodi dolores
                    laudantium molestias nostrum perspiciatis quod? Deserunt dicta dolorem facere fuga hic id magni
                    molestias nihil perspiciatis placeat praesentium quaerat quibusdam, quo reiciendis repellat
                    reprehenderit rerum saepe similique suscipit tempore temporibus totam velit! Accusamus accusantium
                    alias beatae deleniti, dicta dignissimos dolores hic ipsum laboriosam magni minus necessitatibus
                    neque nostrum perspiciatis quam quia repellat tempora ullam voluptate voluptatum? Animi at aut
                    blanditiis cum cumque deleniti deserunt ea eligendi fugit hic illo illum impedit iusto laboriosam
                    laborum minima nesciunt nihil nisi nobis numquam odit omnis praesentium quaerat quis quod recusandae
                    reiciendis sint sunt tenetur ullam vel veritatis, voluptas voluptate! Aliquid aut deserunt dolorum
                    explicabo nisi placeat sed voluptates? A, ab delectus fugiat iste odio optio perferendis placeat
                    reprehenderit soluta temporibus? Accusantium cum illo itaque laborum magni odit officiis provident,
                    quae quam quod soluta velit veniam vitae. Assumenda, at debitis deserunt dolorem earum facilis
                    nesciunt nulla praesentium ut veritatis. Alias animi asperiores at autem beatae commodi consequuntur
                    deserunt, dolores eaque eius eligendi enim eveniet ipsa iste laboriosam laudantium minima molestiae,
                    nam nobis optio porro, quaerat quia quod recusandae repellat repellendus saepe suscipit tempore ut
                    vel. Id quo, vitae? Aliquid blanditiis corporis cum deleniti distinctio, eos iure maiores minima,
                    molestias nesciunt nisi nostrum odit optio perspiciatis porro provident quasi quidem voluptatum! A
                    adipisci aperiam aspernatur assumenda cumque cupiditate ducimus ea, earum enim esse id in iste, iure
                    magnam nemo non nulla omnis perferendis praesentium reprehenderit repudiandae rerum similique
                    suscipit veniam vero voluptates voluptatum! Commodi deleniti non qui quibusdam quis reprehenderit
                    sapiente. Accusamus in perferendis quibusdam repudiandae ullam! Accusantium alias aliquam aspernatur
                    beatae cumque, deserunt dicta distinctio doloremque doloribus est, et fuga illo impedit ipsam ipsum
                    maxime nam officia optio perferendis perspiciatis quasi, quisquam sed vitae. Dignissimos ipsam
                    laboriosam libero quia unde? Consectetur cum delectus doloribus ex excepturi fugiat, illum in
                    inventore ipsam molestiae nisi odio provident quod sit tempore unde veniam voluptates! Architecto
                    molestiae mollitia officia quidem quis repellat reprehenderit! A, ad alias amet dolore enim est ex
                    expedita illo in nemo non nostrum, odio odit placeat quia quis quos sapiente tenetur totam unde.
                    Aliquam animi, architecto asperiores aut blanditiis commodi cumque doloremque error explicabo fugiat
                    incidunt iste iusto nisi numquam omnis, quod recusandae repudiandae rerum saepe tempore temporibus,
                    tenetur vero vitae! Aut blanditiis consectetur et exercitationem id illo, iusto officiis porro qui
                    quo, ratione sed? Ad adipisci alias aliquam amet animi asperiores assumenda at beatae blanditiis
                    commodi culpa cumque cupiditate delectus deleniti dignissimos error est facilis fuga fugiat harum
                    hic illo itaque molestiae nostrum numquam officia officiis pariatur perspiciatis quos reprehenderit,
                    sapiente sunt, suscipit tenetur ut, velit voluptates voluptatum. Ad alias, aliquam deleniti dicta
                    excepturi libero magnam qui tempore unde! Assumenda aut consequatur deleniti dolores error expedita
                    incidunt optio sed tempora vero. Aut labore, officiis. A, accusantium adipisci asperiores,
                    aspernatur commodi deleniti eaque error fuga inventore ipsa quia repellat reprehenderit, sint. A
                    accusamus, ad animi deleniti illo libero modi nam quae quis quisquam rerum sint velit, voluptatum!
                    Accusamus facere quos tempora.

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
@endsection
