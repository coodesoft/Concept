<?php

require_once('GSModel.php');


class Sucursales extends GSModel{


    static function createTable(){

        global $wpdb;
        $table_name = static::getTableName('sucursales');
        $charset_collate = $wpdb->get_charset_collate();
        if( $wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name ) {

            $sql = "CREATE TABLE $table_name (
                id bigint(20) NOT NULL AUTO_INCREMENT,
                client_id bigint(20) NOT NULL,
                sucursal varchar(20) NOT NULL,
                seller_id bigint(20) NOT NULL,
                PRIMARY KEY (id)
            ) $charset_collate;";

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );
        }
    }

    static function validate($params){

      if ( !isset($params['Client_id']) || !isset($params['SucName']) || !isset($params['Seller_id']) )
        return false;

      if (trim($params['Client_id']) != $params['Client_id'])
        return false;

      if (trim($params['SucName']) != $params['SucName'])
        return false;

      if (trim($params['Seller_id']) != $params['Seller_id'])
        return false;

      return true;
    }

    static function add($params){
        $client_id = trim($params['Client_id']);
        $sucursal = trim($params['SucName']);
        $sellerId = trim($params['Seller_id']);

        if (static::validate($params)){
          
          $pricesLists = [];
          foreach($params['PriceList'] as $list){
              $pricesLists[] = $list;
          }

          $stored = static::getSucursal($client_id, $sucursal);
        }


    }

}


?>
