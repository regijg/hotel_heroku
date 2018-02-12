<div class="col-lg-12">
      <div class="box-body" style="width:100%" id="myDivRoomBody">
        <!-- <br></br> -->
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#superiorRoom" data-toggle="tab">Superior Room</a></li>
            <li><a href="#deluxeRoom" data-toggle="tab">Deluxe Room</a></li>
            <li><a href="#juniorSuite" data-toggle="tab">Junior Suite</a></li>
            <li><a href="#executiveSuite" data-toggle="tab">Executive Suite</a></li>
            <li><a href="#deluxeRoyalRoom" data-toggle="tab">Deluxe Royal Room</a></li>
            <li><a href="#juniorSuiteRoyal" data-toggle="tab">Junior Suite Royal</a></li>
            <li><a href="#executiveSuiteRoyal" data-toggle="tab">Executive Suite Royal</a></li>
            <li><a href="#diplomaticSuite" data-toggle="tab">Diplomatic Suite</a></li>
            <li><a href="#presidentialSuite" data-toggle="tab">Presidential Suite</a></li>
          </ul>
          <div class="box-body" id="myDivRoom">
            <div class="tab-content" id="tab_content">
              <div class="tab-pane fade active in" id="superiorRoom">
                <?php foreach ($showDataRoomSuperiorRoom as $isi) if ($isi->room_status == 3) {
                   $status = 'Vacant Dirty';
                    echo ('<tr>
                          <div class="col-lg-2 col-xs-4">
                            <div class="small-box" id="room_floor1" style="background-color:#dbdbe4 !important">
                            <div class="inner">
                              <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>
                              <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                            </div>
                            <div class="icon" style="top:-40px">
                              <i class="fa fa-times" style="font-size:50px"></i>
                            </div>
                              <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                                <i class="fa fa-arrow-circle-right"></i>
                              </a>
                            </div>
                          </div>
                    </tr>');
                }else if($isi->room_status == 2){
                  $status = 'Occupied';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:red">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>
                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-bed" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoomCheckIn('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                } else if($isi->room_status == 4){
                  $status = 'Out of order';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:#f1ad15">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>
                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-wrench" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                }else if ($isi->room_status == 5) {
                  $status = 'booking';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:#00c0ef !important">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-book" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                }else{
                  $status = 'Check-IN';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:#00a65a !important">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-key" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                } {?>
                <?php }?>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="deluxeRoom">
                <?php foreach ($showDataRoomDeluxeRoom as $isi) if ($isi->room_status == 3) {
                   $status = 'Vacant Dirty';
                    echo ('<tr>
                          <div class="col-lg-2 col-xs-4">
                            <div class="small-box" id="room_floor1" style="background-color:#dbdbe4 !important">
                            <div class="inner">
                              <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                              <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                            </div>
                            <div class="icon" style="top:-40px">
                              <i class="fa fa-times" style="font-size:50px"></i>
                            </div>
                              <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                                <i class="fa fa-arrow-circle-right"></i>
                              </a>
                            </div>
                          </div>
                    </tr>');
                }else if($isi->room_status == 2){
                  $status = 'Occupied';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:red">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-bed" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoomCheckIn('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                } else if($isi->room_status == 4){
                  $status = 'Out of order';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:#f1ad15">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-wrench" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                }else if ($isi->room_status == 5) {
                  $status = 'booking';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:#00c0ef !important">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-book" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                }else{
                  $status = 'Check-IN';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:#00a65a !important">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-key" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                } {?>
                <?php }?>
              </div>

              <div class="tab-pane fade in" id="juniorSuite">
                <?php foreach ($showDataRoomJuniorSuite as $isi) if ($isi->room_status == 3) {
                   $status = 'Vacant Dirty';
                    echo ('<tr>
                          <div class="col-lg-2 col-xs-4">
                            <div class="small-box" id="room_floor1" style="background-color:#dbdbe4 !important">
                            <div class="inner">
                              <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                              <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                            </div>
                            <div class="icon" style="top:-40px">
                              <i class="fa fa-times" style="font-size:50px"></i>
                            </div>
                              <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                                <i class="fa fa-arrow-circle-right"></i>
                              </a>
                            </div>
                          </div>
                    </tr>');
                }else if($isi->room_status == 2){
                  $status = 'Occupied';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:red">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-bed" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoomCheckIn('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                } else if($isi->room_status == 4){
                  $status = 'Out of order';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:#f1ad15">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-wrench" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                }else if ($isi->room_status == 5) {
                  $status = 'booking';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:#00c0ef !important">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-book" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                }else{
                  $status = 'Check-IN';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:#00a65a !important">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-key" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                } {?>
                <?php }?>
              </div>

              <div class="tab-pane fade in" id="executiveSuite">
                <?php foreach ($showDataRoomExecutiveSuite as $isi) if ($isi->room_status == 3) {
                   $status = 'Vacant Dirty';
                    echo ('<tr>
                          <div class="col-lg-2 col-xs-4">
                            <div class="small-box" id="room_floor1" style="background-color:#dbdbe4 !important">
                            <div class="inner">
                              <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                              <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                            </div>
                            <div class="icon" style="top:-40px">
                              <i class="fa fa-times" style="font-size:50px"></i>
                            </div>
                              <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                                <i class="fa fa-arrow-circle-right"></i>
                              </a>
                            </div>
                          </div>
                    </tr>');
                }else if($isi->room_status == 2){
                  $status = 'Occupied';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:red">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-bed" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoomCheckIn('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                } else if($isi->room_status == 4){
                  $status = 'Out of order';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:#f1ad15">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-wrench" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                }else if ($isi->room_status == 5) {
                  $status = 'booking';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:#00c0ef !important">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-book" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                }else{
                  $status = 'Check-IN';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:#00a65a !important">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-key" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                } {?>
                <?php }?>
              </div>

              <div class="tab-pane fade in" id="deluxeRoyalRoom">
                <?php foreach ($showDataRoomDeluxeRoyalRoom as $isi) if ($isi->room_status == 3) {
                   $status = 'Vacant Dirty';
                    echo ('<tr>
                          <div class="col-lg-2 col-xs-4">
                            <div class="small-box" id="room_floor1" style="background-color:#dbdbe4 !important">
                            <div class="inner">
                              <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                              <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                            </div>
                            <div class="icon" style="top:-40px">
                              <i class="fa fa-times" style="font-size:50px"></i>
                            </div>
                              <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                                <i class="fa fa-arrow-circle-right"></i>
                              </a>
                            </div>
                          </div>
                    </tr>');
                }else if($isi->room_status == 2){
                  $status = 'Occupied';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:red">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-bed" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoomCheckIn('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                } else if($isi->room_status == 4){
                  $status = 'Out of order';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:#f1ad15">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-wrench" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                }else if ($isi->room_status == 5) {
                  $status = 'booking';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:#00c0ef !important">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-book" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                }else{
                  $status = 'Check-IN';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:#00a65a !important">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-key" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                } {?>
                <?php }?>
              </div>

              <div class="tab-pane fade in" id="juniorSuiteRoyal">
                <?php foreach ($showDataRoomJuniorSuiteRoyal as $isi) if ($isi->room_status == 3) {
                   $status = 'Vacant Dirty';
                    echo ('<tr>
                          <div class="col-lg-2 col-xs-4">
                            <div class="small-box" id="room_floor1" style="background-color:#dbdbe4 !important">
                            <div class="inner">
                              <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                              <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                            </div>
                            <div class="icon" style="top:-40px">
                              <i class="fa fa-times" style="font-size:50px"></i>
                            </div>
                              <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                                <i class="fa fa-arrow-circle-right"></i>
                              </a>
                            </div>
                          </div>
                    </tr>');
                }else if($isi->room_status == 2){
                  $status = 'Occupied';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:red">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-bed" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoomCheckIn('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                } else if($isi->room_status == 4){
                  $status = 'Out of order';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:#f1ad15">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-wrench" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                }else if ($isi->room_status == 5) {
                  $status = 'booking';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:#00c0ef !important">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-book" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                }else{
                  $status = 'Check-IN';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:#00a65a !important">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-key" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                } {?>
                <?php }?>
              </div>

              <div class="tab-pane fade in" id="executiveSuiteRoyal">
                <?php foreach ($showDataRoomExecutiveSuiteRoyal as $isi) if ($isi->room_status == 3) {
                   $status = 'Vacant Dirty';
                    echo ('<tr>
                          <div class="col-lg-2 col-xs-4">
                            <div class="small-box" id="room_floor1" style="background-color:#dbdbe4 !important">
                            <div class="inner">
                              <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                              <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                            </div>
                            <div class="icon" style="top:-40px">
                              <i class="fa fa-times" style="font-size:50px"></i>
                            </div>
                              <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                                <i class="fa fa-arrow-circle-right"></i>
                              </a>
                            </div>
                          </div>
                    </tr>');
                }else if($isi->room_status == 2){
                  $status = 'Occupied';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:red">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-bed" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoomCheckIn('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                } else if($isi->room_status == 4){
                  $status = 'Out of order';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:#f1ad15">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-wrench" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                }else if ($isi->room_status == 5) {
                  $status = 'booking';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:#00c0ef !important">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-book" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                }else{
                  $status = 'Check-IN';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:#00a65a !important">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-key" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                } {?>
                <?php }?>
              </div>

              <div class="tab-pane fade in" id="diplomaticSuite">
                <?php foreach ($showDataRoomDiplomaticSuite as $isi) if ($isi->room_status == 3) {
                   $status = 'Vacant Dirty';
                    echo ('<tr>
                          <div class="col-lg-2 col-xs-4">
                            <div class="small-box" id="room_floor1" style="background-color:#dbdbe4 !important">
                            <div class="inner">
                              <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                              <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                            </div>
                            <div class="icon" style="top:-40px">
                              <i class="fa fa-times" style="font-size:50px"></i>
                            </div>
                              <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                                <i class="fa fa-arrow-circle-right"></i>
                              </a>
                            </div>
                          </div>
                    </tr>');
                }else if($isi->room_status == 2){
                  $status = 'Occupied';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:red">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-bed" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoomCheckIn('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                } else if($isi->room_status == 4){
                  $status = 'Out of order';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:#f1ad15">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-wrench" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                }else if ($isi->room_status == 5) {
                  $status = 'booking';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:#00c0ef !important">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-book" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                }else{
                  $status = 'Check-IN';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:#00a65a !important">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-key" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                } {?>
                <?php }?>
              </div>

              <div class="tab-pane fade in" id="presidentialSuite">
                <?php foreach ($showDataRoomPresidentialSuite as $isi) if ($isi->room_status == 3) {
                   $status = 'Vacant Dirty';
                    echo ('<tr>
                          <div class="col-lg-2 col-xs-4">
                            <div class="small-box" id="room_floor1" style="background-color:#dbdbe4 !important">
                            <div class="inner">
                              <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                              <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                            </div>
                            <div class="icon" style="top:-40px">
                              <i class="fa fa-times" style="font-size:50px"></i>
                            </div>
                              <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                                <i class="fa fa-arrow-circle-right"></i>
                              </a>
                            </div>
                          </div>
                    </tr>');
                }else if($isi->room_status == 2){
                  $status = 'Occupied';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:red">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-bed" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoomCheckIn('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                } else if($isi->room_status == 4){
                  $status = 'Out of order';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:#f1ad15">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-wrench" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                }else if ($isi->room_status == 5) {
                  $status = 'booking';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:#00c0ef !important">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-book" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                }else{
                  $status = 'Check-IN';
                  echo ('<tr>
                        <div class="col-lg-2 col-xs-4">
                          <div class="small-box" id="room_floor1" style="background-color:#00a65a !important">
                          <div class="inner">
                            <h3>'.$isi->room_number.'<sup style="font-size: 20px"></sup></h3>

                            <input type="hidden" value='.$isi->room_status.' id="room_status"></input>
                          </div>
                          <div class="icon" style="top:-40px">
                            <i class="fa fa-key" style="font-size:50px"></i>
                          </div>
                            <a href="javascript:;" onclick="openFormRoom('.$isi->room_number.')" class="small-box-footer" id="room_status_id">
                              '.$status.'
                              <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                        </div>
                  </tr>');
                } {?>
                <?php }?>
              </div>
              <!-- /.tab-pane -->
            </div>
          </div>
          <!-- /.tab-content -->
        </div>
      </div>
  </div>
