<?php
if( !function_exists( 'sd_kml_extractors' ) ){
  function sd_kml_extractors($url = string){
    $exploded_value    = '';
    $contents = file_get_contents($url);
    if( empty( $contents ) ){
      return;
    }
    $xml          = new SimpleXMLElement($contents);
    $coord_value  = (array)null;
    if( !empty( $xml ) ){
      $coord          = $xml->Document->Placemark->Polygon->outerBoundaryIs->LinearRing->coordinates;
      $trimmed_value  = trim(preg_replace('/\s+/', ' ', $coord[0] ) );
      $exp_coord      = explode(',0', $trimmed_value);
      foreach( $exp_coord as $key => $value ){
        $exploded_value = explode(',', $value );
        $lngCoord = isset( $exploded_value[0] ) ? $exploded_value[0] : 0;
        $latValue = isset( $exploded_value[1] ) ? $exploded_value[1] : 0;
        $coord_value[$key]['lat'] = (float)$latValue;
        $coord_value[$key]['lng'] = (float)$lngCoord;
      }
    }
    return apply_filters( 'sd_xml_extractor', $coord_value );
  }
}