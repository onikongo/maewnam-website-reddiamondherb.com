<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 fon_main text-center">
	<center><p class="fon_main textreview">ผลตอบรับจากผู้ใช้</p></center><hr class="hrl">
</div>


<style>
        
        /* jssor slider arrow navigator skin 02 css */
        /*
        .jssora02l                  (normal)
        .jssora02r                  (normal)
        .jssora02l:hover            (normal mouseover)
        .jssora02r:hover            (normal mouseover)
        .jssora02l.jssora02ldn      (mousedown)
        .jssora02r.jssora02rdn      (mousedown)
        */
        .jssora02l, .jssora02r {
            display: block;
            position: absolute;
            /* size of arrow element */
            width: 55px;
            height: 55px;
            cursor: pointer;
            background: url('upload/a02.png') no-repeat;
            overflow: hidden;
			transform: scale(0.7);
        }
        .jssora02l { background-position: -3px -33px; }
        .jssora02r { background-position: -63px -33px; }
        .jssora02l:hover { background-position: -123px -33px; }
        .jssora02r:hover { background-position: -183px -33px; }
        .jssora02l.jssora02ldn { background-position: -3px -33px; }
        .jssora02r.jssora02rdn { background-position: -63px -33px; }

        /* jssor slider thumbnail navigator skin 03 css */
        /*
        .jssort03 .p            (normal)
        .jssort03 .p:hover      (normal mouseover)
        .jssort03 .pav          (active)
        .jssort03 .pdn          (mousedown)
        */
        
        .jssort03 .p {
            position: absolute;
            top: 0;
            left: 0;
            width: 62px;
            height: 32px;
        }
        
        .jssort03 .t {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
        
        .jssort03 .w, .jssort03 .pav:hover .w {
            position: absolute;
            width: 60px;
            height: 30px;
            border: white 1px dashed;
            box-sizing: content-box;
        }
        
        .jssort03 .pdn .w, .jssort03 .pav .w {
            border-style: solid;
        }
        
        .jssort03 .c {
            position: absolute;
            top: 0;
            left: 0;
            width: 62px;
            height: 32px;
            background-color: #000;
        
            filter: alpha(opacity=45);
            opacity: .45;
            transition: opacity .6s;
            -moz-transition: opacity .6s;
            -webkit-transition: opacity .6s;
            -o-transition: opacity .6s;
        }
        
        .jssort03 .p:hover .c, .jssort03 .pav .c {
            filter: alpha(opacity=0);
            opacity: 0;
        }
        
        .jssort03 .p:hover .c {
            transition: none;
            -moz-transition: none;
            -webkit-transition: none;
            -o-transition: none;
        }
        
        * html .jssort03 .w {
            width /**/: 62px;
            height /**/: 32px;
        }
        
    </style>
     <script>
        jssor_1_slider_init = function() {
            
            var jssor_1_options = {
              $AutoPlay: true,
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $ThumbnailNavigatorOptions: {
                $Class: $JssorThumbnailNavigator$,
                $Cols: 9,
                $SpacingX: 3,
                $SpacingY: 3,
                $Align: 260
              }
            };
            
            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);
            
            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizing
            //function ScaleSlider() {
//                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
//                if (refSize) {
//                    refSize = Math.min(refSize, 600);
//                    jssor_1_slider.$ScaleWidth(refSize);
//                }
//                else {
//                    window.setTimeout(ScaleSlider, 30);
//                }
//            }
            //ScaleSlider();
            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            //$Jssor$.$AddEvent(window, "resize", $Jssor$.$WindowResizeFilter(window, ScaleSlider));
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            //responsive code end
        };
		$("#jssor_1").children().css({"transform":"scale(1)"});
    </script>
<div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 300px; height: 700px; overflow: hidden; visibility: hidden;transform: scale(1) !important;margin-bottom: -80px;">
        <!-- Loading Screen -->
        <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
            <div style="position:absolute;display:block;background:url('../img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
        </div>
        <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 300px; height: 700px; overflow: hidden;transform: scale(1) !important;">
            <div data-p="112.50" style="display: none;">
                <img data-u="" src="../libs/img/product/feedback/ch_fb1.jpg" width="100%" />
                <img data-u="thumb" src="../../libs/img/product/feedback/ch_fb1.jpg" />
            </div>
            <div data-p="112.50" style="display: none;">
                <img data-u="" src="../libs/img/product/feedback/ch_fb2.jpg" width="100%" />
                <img data-u="thumb" src="../libs/img/product/feedback/ch_fb2.jpg" />
            </div>
            <div data-p="112.50" style="display: none;">
                <img data-u="" src="../libs/img/product/feedback/ch_fb3.jpg" width="100%" />
                <img data-u="thumb" src="../libs/img/product/feedback/ch_fb3.jpg" />
            </div>
            <div data-p="112.50" style="display: none;">
                <img data-u="" src="../libs/img/product/feedback/ch_fb4.jpg" width="100%" />
                <img data-u="thumb" src="../libs/img/product/feedback/ch_fb4.jpg" />
            </div>
            <div data-p="112.50" style="display: none;">
                <img data-u="" src="../libs/img/product/feedback/ch_fb5.jpg" width="100%" />
                <img data-u="thumb" src="../libs/img/product/feedback/ch_fb5.jpg" />
            </div>
            <div data-p="112.50" style="display: none;">
                <img data-u="" src="../libs/img/product/feedback/ch_fb6.jpg" width="100%" />
                <img data-u="thumb" src="../libs/img/product/feedback/ch_fb6.jpg" />
            </div>
            <div data-p="112.50" style="display: none;">
                <img data-u="" src="../libs/img/product/feedback/ch_fb7.jpg" width="100%" />
                <img data-u="thumb" src="../libs/img/product/feedback/ch_fb7.jpg" />
            </div>
            <div data-p="112.50" style="display: none;">
                <img data-u="" src="../libs/img/product/feedback/ch_fb8.jpg" width="100%" />
                <img data-u="thumb" src="../libs/img/product/feedback/ch_fb8.jpg" />
            </div>
            <div data-p="112.50" style="display: none;">
                <img data-u="" src="../libs/img/product/feedback/ch_fb9.jpg" width="100%" />
                <img data-u="thumb" src="../libs/img/product/feedback/ch_fb9.jpg" />
            </div>
            <div data-p="112.50" style="display: none;">
                <img data-u="" src="../libs/img/product/feedback/ch_fb10.jpg" width="100%" />
                <img data-u="thumb" src="../libs/img/product/feedback/ch_fb10.jpg" />
            </div>
            <div data-p="112.50" style="display: none;">
                <img data-u="" src="../libs/img/product/feedback/ch_fb11.jpg" width="100%" />
                <img data-u="thumb" src="../libs/img/product/feedback/ch_fb11.jpg" />
            </div>
            <div data-p="112.50" style="display: none;">
                <img data-u="" src="../libs/img/product/feedback/ch_fb12.jpg" width="100%" />
                <img data-u="thumb" src="../libs/img/product/feedback/ch_fb12.jpg" />
            </div>
            <div data-p="112.50" style="display: none;">
                <img data-u="" src="../libs/img/product/feedback/ch_fb13.jpg" width="100%" />
                <img data-u="thumb" src="../libs/img/product/feedback/ch_fb13.jpg" />
            </div>
            <div data-p="112.50" style="display: none;">
                <img data-u="" src="../libs/img/product/feedback/ch_fb14.jpg" width="100%" />
                <img data-u="thumb" src="../libs/img/product/feedback/ch_fb14.jpg" />
            </div>
            <div data-p="112.50" style="display: none;">
                <img data-u="" src="../libs/img/product/feedback/ch_fb15.jpg" width="100%" />
                <img data-u="thumb" src="../libs/img/product/feedback/ch_fb15.jpg" />
            </div>
            <div data-p="112.50" style="display: none;">
                <img data-u="" src="../libs/img/product/feedback/ch_fb16.jpg" width="100%" />
                <img data-u="thumb" src="../libs/img/product/feedback/ch_fb16.jpg" />
            </div>
            <div data-p="112.50" style="display: none;">
                <img data-u="" src="../libs/img/product/feedback/ch_fb17.jpg" width="100%" />
                <img data-u="thumb" src="../libs/img/product/feedback/ch_fb17.jpg" />
            </div>
			<div data-p="112.50" style="display: none;">
                <img data-u="" src="../libs/img/product/feedback/ch_fb18.jpg" width="100%" />
                <img data-u="thumb" src="../libs/img/product/feedback/ch_fb18.jpg" />
            </div>
            <div data-p="112.50" style="display: none;">
                <img data-u="" src="../libs/img/product/feedback/ch_fb19.jpg" width="100%" />
                <img data-u="thumb" src="../libs/img/product/feedback/ch_fb19.jpg" />
            </div>
            <div data-p="112.50" style="display: none;">
                <img data-u="" src="../libs/img/product/feedback/ch_fb20.jpg" width="100%" />
                <img data-u="thumb" src="../libs/img/product/feedback/ch_fb20.jpg" />
            </div>
            <div data-p="112.50" style="display: none;">
                <img data-u="" src="../libs/img/product/feedback/ch_fb21.jpg" width="100%" />
                <img data-u="thumb" src="../libs/img/product/feedback/ch_fb21.jpg" />
            </div>
                        
        </div>
        <!-- Thumbnail Navigator -->
        <div u="thumbnavigator" class="jssort03" style="position:absolute;left:0px;bottom:110px;width:600px;height:60px;" data-autocenter="1">
            <div style="position: absolute; top: 0; left: 0; width: 100%; height:100%; background-color: #000; filter:alpha(opacity=30.0); opacity:0.3;"></div>
            <!-- Thumbnail Item Skin Begin -->
            <div u="slides" style="cursor: default;">
                <div u="prototype" class="p">
                    <div class="w">
                        <div u="thumbnailtemplate" class="t"></div>
                    </div>
                    <div class="c"></div>
                </div>
            </div>
            <!-- Thumbnail Item Skin End -->
        </div>
        <!-- Arrow Navigator -->
        <span data-u="arrowleft" class="jssora02l" style="top:0px;left:8px;width:55px;height:55px;" data-autocenter="2"></span>
        <span data-u="arrowright" class="jssora02r" style="top:0px;right:8px;width:55px;height:55px;" data-autocenter="2"></span>
        <a href="http://www.jssor.com" style="display:none">Bootstrap Carousel</a>
    </div>
    <script>
        jssor_1_slider_init();
    </script>
<center><span>*ผลลัพธ์อาจเปลี่ยนแปลงไปในแต่ละบุคคล ขึ้นอยู่กับระยะเวลาและระดับของอาการ</span></center>