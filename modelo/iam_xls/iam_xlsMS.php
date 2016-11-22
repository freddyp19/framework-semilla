<?

/**
 *  iam_xlsMS class modified by Robin Newman to work with MS SQLserver and PHP MSSQL extensions
 *  translation is fairly straigthforward, apart from error handling which is more basic as no equivalend to MySql_Error function
  * other change is to add error handling for strings > 255 characters which are truncated in this Excel file format.
   ******************************************************************************************************************
 *  IAM_XLS A class for generating an XLS file. Alternatively, it can be used for performing a query dump and sending it to the browser as an Excel File
 *  @package    iam_xls
 */

 /**
 *  IAM_XLS A class for generating an XLS file. Alternatively, it can be used for performing a query dump and sending it to the browser as an Excel File
 *  @author     Iván Ariel Melgrati <phpclasses@imelgrat.mailshell.com>
 *  @package    iam_csvdump
 *  @version 1.0
 *
 *  IAM_XLS A class for generating an XLS file. Alternatively, it can be used for performing a query dump and sending it to the browser as an Excel File
 *
 *  Browser and OS detection for appropriate handling of download.
 *
 *  Requires PHP v 4.0+ and MSSQL. Some portions taken from the DzaiaCuck's sqltoexcel class <dzaiacuck@ig.com.br>
 *
 *  This library is free software; you can redistribute it and/or
 *  modify it under the terms of the GNU Lesser General Public
 *  License as published by the Free Software Foundation; either
 *  version 2 of the License, or (at your option) any later version.
 *
 *  This library is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 *  Lesser General Public License for more details.
 */
class IAM_XLS
{
     /**
     * @var string $xls_data Variable that holds the XLS File
     * @access private
     */
     var $xls_data;

     /**
     * @var string $xlsName Output Filename. No extension should be given as the class, as the class automatically attaches the XLS extension
     * @access private
     */
     var $xlsName;

    /**
    * @access public
    * @param  String $filename Output Filename. No extension should be given as the class, as the class automatically attaches the XLS extension
    */
     function IAM_XLS($filename='spreadsheet')
     {
          $this->xls_data   = "";
          $this->xlsName = $filename;
          $this->_excelStart();
     }


    /**
    * @desc Writes a value to a cell in the in-memory file
    * @access public
    * @param int $xls_line Spreadsheet row (zero-based)
    * @param int $xls_col Spreadsheet column (zero-based)
    * @param mixed $value Cell value (String or Numeric)
    */
     function WriteValue($xls_row, $xls_col, $value)
     {
          if (is_numeric($value))
               $this->WriteCellNumber($xls_row, $xls_col, $value);
          else
               $this->WriteCellText($xls_row, $xls_col, $value);
     }

    /**
    * @desc Generates a XLS File from an SQL Query (and outputs it to the browser)
    * @access public
    * @param  String $query Query String
    * @param  String $db Name of the Database
    * @param  String $user User to Access the Database
    * @param  String $pass Password to Access the Database
    * @param  String $host Name of the Host holding the DB
    */
     function WriteSQLDump($query, $db, $user='root', $pass='', $host='localhost')
     {
          $xls_line  = 0;
          $col = 0;

          $link = $this->_db_connect($db, $user, $pass, $host);
          if($link)
          {
               $result= @mssql_query($query, $link);
               if(!$result)
               {
                    $this->WriteValue(1, 0, "An error occured while excuting the query ".$query);
                    $this->OutputFile();
                    exit();
               }

               $lines  = @mssql_num_rows($result);
               $colums = mssql_num_fields($result);

               for($e=0; $e < $colums; $e++)
                    $this->WriteValue(0, $e, trim(ucwords(str_replace("_"," ",mssql_field_name($result, $e)))));

               for($col = 0; $col < $colums; $col++)
               {
               	$col_name  = mssql_field_name($result, $col);

                    for($i=0; $i < $lines; $i++)
               	{
                              $CellValue = mssql_result($result, $i, $col_name);

               	          $xls_line = ($i + 1);

               	          $this->WriteValue($xls_line, $col, $CellValue);
               	}
               }
          }
          else
          {
               $this->WriteValue(1, 0, "Could not connect to the database:");
          }
          $this->OutputFile();
     }

    /**
    * @desc Closes the XLS File and Sends it to the browser
    * @access public
    */
     function OutputFile()
     {
          $this->_excelEnd();

          $now = gmdate('D, d M Y H:i:s') . ' GMT';
          $USER_BROWSER_AGENT= $this->_get_browser_type();

          header('Content-Type: ' . $this->_get_mime_type());
          header ( "Content-Description: IAM Generated Excel File" );
          header('Expires: ' . $now);

          if ($USER_BROWSER_AGENT == 'IE')
          {
            header('Content-Disposition: attachment; filename="' . $this->xlsName.".xls");
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
          }
          else
          {
            header('Content-Disposition: attachment; filename="' . $this->xlsName.".xls");
            header('Pragma: no-cache');
          }

          print  ($this->xls_data);
     }

    /**
    * @desc Writes The XLS Header to the in-memory file
    * @access private
    */
     function _excelStart()
     {
          $this->xls_data = pack( "vvvvvv", 0x809, 0x08, 0x00,0x10, 0x0, 0x0 );
     }

    /**
    * @desc Writes The XLS End-of-File sequence to the in-memory file
    * @access private
    */
     function _excelEnd()
     {
          $this->xls_data .= pack( "vv", 0x0A, 0x00);
     }



    /**
    * @desc Writes a numeric value to a cell in the in-memory file
    * @access public
    * @param int $xls_row Spreadsheet row (zero-based)
    * @param int $xls_col Spreadsheet column (zero-based)
    * @param float $value Cell value
    */
     function WriteCellNumber($xls_row, $xls_col, $value)
     {
        settype($value,'float');
        settype($row, 'integer');
        settype($col, 'integer');

        $this->xls_data .= pack( "sssss", 0x0203, 14, $xls_row, $xls_col, 0x00 );
        $this->xls_data .= pack( "d", $value );
     }

    /**
    * @desc Writes a string value to a cell in the in-memory file
    * @access public
    * @param int $xls_row Spreadsheet row (zero-based)
    * @param int $xls_col Spreadsheet column (zero-based)
    * @param float $value Cell value
    */
	/**
	* Error handling for long strings, added by Robin Newman
	*/
     function WriteCellText( $xls_row, $xls_col, $value )
     {
          settype($value,'string');
          settype($row, 'integer');
          settype($col, 'integer');

          $len = strlen( $value );if($len>255){$value="#STRING TOO LONG:".$len;$len=strlen($value);}
          $this->xls_data .= pack( "s*", 0x0204, 8 + $len, $xls_row, $xls_col, 0x00, $len );
          $this->xls_data .= $value;
     }


    /**
    * @desc Connects to a MSSQL Server and select the given Database
    * @access private
    * @param  String $dbname Name of the Database
    * @param  String $user User to Access the Database
    * @param  String $password Password to Access the Database
    * @param  String $host Name of the Host holding the DB
    * @return resource if connection was successful | FALSE
    */
    function _db_connect($dbname="mssql", $user="root", $password="", $host="localhost")
    {
      $result = @mssql_connect($host, $user, $password);
      if(!$result)     // If no connection, return 0
      {
       return false;
      }

      if(!@mssql_select_db($dbname))  // If db not set, return 0
      {
       return false;
      }
      return $result;
    }

    /**
    * @desc Define the client's browser type
    * @access private
    * @return String A String containing the Browser's type or brand
    */
    function _get_browser_type()
    {
        $USER_BROWSER_AGENT="";

        if (ereg('OPERA(/| )([0-9].[0-9]{1,2})', strtoupper($_SERVER["HTTP_USER_AGENT"]), $log_version))
        {
            $USER_BROWSER_AGENT='OPERA';
        }
        else if (ereg('MSIE ([0-9].[0-9]{1,2})',strtoupper($_SERVER["HTTP_USER_AGENT"]), $log_version))
        {
            $USER_BROWSER_AGENT='IE';
        }
        else if (ereg('OMNIWEB/([0-9].[0-9]{1,2})', strtoupper($_SERVER["HTTP_USER_AGENT"]), $log_version))
        {
            $USER_BROWSER_AGENT='OMNIWEB';
        }
        else if (ereg('MOZILLA/([0-9].[0-9]{1,2})', strtoupper($_SERVER["HTTP_USER_AGENT"]), $log_version))
        {
            $USER_BROWSER_AGENT='MOZILLA';
        }
        else if (ereg('KONQUEROR/([0-9].[0-9]{1,2})', strtoupper($_SERVER["HTTP_USER_AGENT"]), $log_version))
        {
            $USER_BROWSER_AGENT='KONQUEROR';
        }
        else
        {
            $USER_BROWSER_AGENT='OTHER';
        }

        return $USER_BROWSER_AGENT;
    }

    /**
    * @desc Define MIME-TYPE according to target Browser
    * @access private
    * @return String A string containing the MIME-TYPE String corresponding to the client's browser
    */
    function _get_mime_type()
    {
        $USER_BROWSER_AGENT= $this->_get_browser_type();

        $mime_type = ($USER_BROWSER_AGENT == 'IE' || $USER_BROWSER_AGENT == 'OPERA')
                       ? 'application/octetstream'
                       : 'application/octet-stream';
        return $mime_type;
    }

}

?>
