<?php
if ( !defined( 'ABSPATH' ) ) {
  die( '-1' );
}

class WPBakeryShortCode_icw_calculator_form extends WPBakeryShortCode {


    protected function content( $atts, $content = null ) {

      extract( shortcode_atts( array(
        'animate_block' => 'false',
        'animation_type' => 'fadeIn',
        'animation_delay' => '',
      ), $atts ) );


      ob_start();

      $wrapper_class = array();

      if ( $animate_block == 'yes' ) {
        $wrapper_class[] = 'wow';
        $wrapper_class[] = $animation_type;
      }

      $wrapper_class = implode( ' ', $wrapper_class );


      $details = vc_param_group_parse_atts( $atts[ 'details' ] );
      ?>

<form class="calculator-form">
          <div class="row">
            <div class="form-group col-md-6">
              <p>How many rooms :</p>
              <div class="range-slider">
                <input class="range-slider__range" type="range" value="4" min="0" max="8" step="1">
                <span class="range-slider__value">0</span> </div>
              <!-- edn range-slider --> 
            </div>
            <!-- end form-group -->
            <div class="form-group col-md-6">
              <p>Number of floor :</p>
              <div class="range-slider">
                <input class="range-slider__range" type="range" value="2" min="0" max="12" step="2">
                <span class="range-slider__value">0</span> </div>
              <!-- edn range-slider --> 
            </div>
            <!-- end form-group -->
            <div class="form-group col-lg-4 col-md-6">
              <p>Energy Type :</p>
              <select>
                <option>Bank of America</option>
              </select>
            </div>
            <!-- end form-group -->
            
            <div class="form-group col-lg-4 col-md-6">
              <p>Bathroom :</p>
              <select>
                <option>Bank of America</option>
              </select>
            </div>
            <!-- end form-group -->
            
            <div class="form-group col-lg-4 col-md-12">
              <p>Terrace :</p>
              <div class="yes-no">
                <input type="radio" name="rdo" id="yes" checked />
                <input type="radio" name="rdo" id="no"/>
                <div class="switch">
                  <label for="yes">Yes</label>
                  <label for="no">No</label>
                  <span></span> </div>
              </div>
              <!-- end yes-no --> 
            </div>
            <!-- end form-group -->
            <div class="form-group col-12">
              <p>Building Materials</p>
              <input type="checkbox" id="one" checked>
              <label class="custom-checkbox" for="one"> Cellular Concrete </label>
              <input type="checkbox" id="two">
              <label class="custom-checkbox" for="two"> Ventilated Brick </label>
              <input type="checkbox" id="three">
              <label class="custom-checkbox" for="three"> Wood </label>
              <input type="checkbox" id="four">
              <label class="custom-checkbox" for="four"> Prefabricated </label>
            </div>
            <!-- end form-group -->
            <div class="form-group col-12">
              <div class="info-box"> <i class="lni lni-checkmark-circle"></i> Explore Cheatsheet to Start Using With Your Projects. </div>
              <!-- end info-box -->
              <div class="price-box"> <small>Estimated Price :</small> <span>$ 67.800</span> </div>
              <!-- end price-box --> 
            </div>
            <!-- end form-group --> 
          </div>
          <!-- end form row -->
        </form>




<?php
return ob_get_clean();
}
}


vc_map( array(
  "base" => "icw_calculator_form",
  "name" => __( 'Calculator Form', 'ICWTHEME' ),
  "icon" => ICW_CORE_URI . "assets/img/icw.png",
  "content_element" => true,
  "category" => PAGE_BUILDER_GROUP,
  'params' => array(

    array(
      'type' => 'param_group',
      'param_name' => 'details',
      'heading' => __( 'List Item', 'ICWTHEME' ),
      'params' => array(

        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => __( "List", 'ICWTHEME' ),
          "param_name" => "list",
          "value" => "",
          'admin_label' => true
        ),

      ),

    ),
    array(
      "type" => "dropdown",
      "heading" => __( 'Animate', 'ICWTHEME' ),
      "param_name" => "animate_block",
      "group" => 'Animation',
      "value" => array(
        "No" => 'no',
        "Yes" => 'yes',
      )
    ),
    array(
      "type" => "dropdown",
      "heading" => __( 'Animation Type', 'ICWTHEME' ),
      "param_name" => "animation_type",
      "dependency" => array( 'element' => "animate_block", 'value' => 'yes' ),
      "group" => 'Animation',
      "value" => icw_animations()
    ),
    array(
      "type" => "textfield",
      "heading" => __( 'Animation Delay', 'ICWTHEME' ),
      "param_name" => "animation_delay",
      "dependency" => array( 'element' => "animate_block", 'value' => 'yes' ),
      "description" => __( 'Animation delay set in second e.g. 0.6s', 'ICWTHEME' ),
      "group" => 'Animation',
    ),
  ) ) );
