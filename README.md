# MT103-Parser
A simple PHP Parser for converting Swift MT 103 text file into PHP array / object 

This parser will let you read and parse SWIFT MT 103 message into a PHP Array or object for accessing values in various tags. 

 - MT 103 Single Customer Credit Transfer 
 - MT 103+ (REMIT) Single Customer Credit Transfer (REMIT) 
 - MT 103+ (STP) Single Customer Credit Transfer (STP)

You can read more about the format here 
https://en.wikipedia.org/wiki/MT103

Though it parses message into arrays, no validations are performed. A sample message would look like:

    {1:F01CRESCHZZB80A2076969842}{2:I103BNPAFRPPAXXXN2020}{3:{121:180f1e65-90e0-44d5-a49a-92b55eb3025f}}{4:
    :20:UniqRefOfTRSX16x
    :23B:CRED
    :32A:180724EUR735927,75
    :33B:EUR735927,75
    :50K:/CH5704835098735711000
    GALLMAN COMPANY GMBH
    RAEMISTRASSE, 71
    8006 ZURICH
    SWITZERLAND
    :59:/FR7630004008180001236749327
    DUPONT SARL 21 RUE DU COMMERCE
    PARIS
    :71A:SHA
    -}


Sample usage (See MT103ParserUsage.php)

    $message  =  "{1:F21BANKINBBA9999999999999}{4:{177:2009091610}{451:0}}{1:F01BANKINBBA9999999999999}{2:O1030434200909RRRRRR33GXXX22845675702009091610N}{3:{108:2090904333110H00}{111:001}{121:f81b7e40-f276-41ea-aa43-b43b469b4411}{433:/FPO/FALSE POSITIVE}}{4:
    :20:S0602888881D01
    :23B:CRED
    :32A:200909USD16548,8
    :33B:USD16596,8
    :50K:/712777777770
    XXXXXX TECHNOLOGY (M) SDN. BH
    XXX 9999 YYYYY XXXX 6
    XXX YYYY XXXX TTTT
    23467 CDDRE ERRTTY
    :52A:QWERTYLXXX
    :53A:WERTYUBBXXX
    :59:/99999901
    XXX INDUSTRIES LIMITED
    XXXX HOUSE XXXXX PARK
    XION XXXX XXXX REXSDDD SDSSSS
    INDIA
    :70:WERSDF XSXWSW H500KR
    :71A:SHA
    :71F:USD48,00
    -}{5:{MAC:00000000}{CHK:F999EE8385DB}{DLM:}}{S:{SAC:}{COP:S}}";
    
    require_once('MT103Parser.php');
    $messageObject  = (new  MT103Parser($message))->processMessage() ;
    var_dump($messageObject->T1 );
    
    /* outputs
    array(2) {
    [0]=>
    string(25) "F21BANKINBBA9999999999999"
    [1]=>
    string(25) "F01BANKINBBA9999999999999"
    }
    */
      
    var_dump($messageObject->T4->T20 );
    
    /* outputs
    string(14) "S0602888881D01"
    */


Feel free to suggest improvements and bug fixes
