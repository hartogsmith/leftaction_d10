 <?php
 /* 3.17 added new show/require config for some fields (*)
group_action
field_action_title
field_action_img
field_action_featured
field_photo_credit
field_action_summary
field_action_cta
field_salsa_link
field_email_trigger_keys
field_redirect
field_show_extra_fields
field_show_first_name *
field_require_first_name *
field_show_last_name *
field_require_last_name *
field_show_street_address *
field_require_street_address *
field_show_city *
field_require_city *
field_show_country *
field_require_country *
field_show_comments *
field_require_comments *
field_category
field_show_headline_and_shares
group_org
field_org_name
field_org_tagline
field_org_logo
field_client
*/
?>



<?php
    function VerifyField($field){
        if (isset($field) && ($field == 1)){
            return 1;
        } else {
            return 0;
        }
    }
// Load the currently logged in user.
/*
global $user;
// Check if the user has the 'editor' role.
if (in_array('admin', $user->roles)) { 
    echo 'admin';
    if (isset($node->field_show_first_name['und'][0]['value']) && count($node->field_show_first_name['und'][0]['value']) > 0){
    $output_field = $node->field_show_first_name['und'][0]['value'];

    print 'field_show_first_name:' . $output_field;
    }
    print '<br>';
    print 'field_show_last_name:' . $node->field_show_last_name['und'][0]['value'];
    print '<br>';
    print 'field_require_last_name:' . $node->field_require_last_name['und'][0]['value'];
    print '<br>';
    print 'field_show_address:' . $node->field_show_address['und'][0]['value'];
    print '<br>';
    print 'field_show_comments:' . $node->field_show_comments['und'][0]['value'];
    print '<br>';
    print 'field_require_comments:' . $node->field_require_comments['und'][0]['value'];
    print '<br>';

    print '<br>';
    echo "show comments?: " . VerifyField($node->field_show_comments['und'][0]['value']);
    print '<br>';
    echo "require comments?: " . VerifyField($node->field_require_comments['und'][0]['value']);
    print '<br>';
    echo "show address?: " . VerifyField($node->field_show_address['und'][0]['value']);
    print '<br>';
    echo "require address?: " . VerifyField($node->field_require_address['und'][0]['value']);
    print '<br>';
    if(VerifyField($node->field_require_comments['und'][0]['value'])):
        print 'yup';
    endif;
}
*/
?>

 <div id="node-<?php print $node->nid; ?>" class="row <?php print $classes; ?>"<?php print $attributes; ?>>
  <div class="col-sm-6 col-xs-12 leftcol col-sm-push-6">

     <?php
      $key = ''; 
      $sourceURL  = render($content['field_salsa_link']);
      $sourceURLBits = explode("action_KEY=", $sourceURL);
      $p_actionKey = strip_tags($sourceURLBits[1]); 
    ?>
    <div id="action_action">
      <h2>Add Your Name!</h2>
      <?php
        // key=60993401 empty redirect
        // key=44250685 already signed redirect

        if ($_GET["key"] == "44250685") {
        echo '<div class="signed alert">Looks like you\'ve already signed this petition. Would you like to see <a href="/actions">some others</a>?</div>';
        }
        ?>

        <?php /* (3.17) replaced this group show/hide w/ some individual show/require logic 
        $showExtraFields = render($content['field_show_extra_fields']['#items']['0']['value']); 
        */ ?>


        <form id="salsa-petition" class="salsa" action="https://salsa.wiredforchange.com/save" method="POST">
          <input type="hidden" name="organization_KEY" value="6461"/>
          <input type="hidden" name="email_trigger_KEYS" value="<?php print render($content['field_email_trigger_keys']['#items']['0']['value']); ?>"/>
          <input type="hidden" name="object" value="supporter"/>

        
        <?php /* (3.17) using new display/require config for some fields */ ?>
        <?php if(VerifyField($node->field_show_first_name['und'][0]['value'])): ?>
        <input type="text" id="firstname" name="First_Name" placeholder="First Name" class="<?php if(VerifyField($node->field_require_first_name['und'][0]['value'])): ?>required <?php endif; ?>" />
        <?php endif; ?>

        <?php if(VerifyField($node->field_show_last_name['und'][0]['value'])): ?>
        <input type="text" id="lastname" name="Last_Name" placeholder="Last Name" class="<?php if(VerifyField($node->field_require_last_name['und'][0]['value'])): ?>required <?php endif; ?>" />
        <?php endif; ?>
          
        <input type="email" id="email" name="Email" placeholder="Email" class="required" />
        
        <?php if(VerifyField($node->field_show_street_address['und'][0]['value'])): ?>
        <input title="Street 1" type="text" id="f4" name="Street" class="<?php if(VerifyField($node->field_require_street_address['und'][0]['value'])): ?>required <?php endif; ?> salsa_street" placeholder="Street Address">
        <?php endif; ?>

        <?php if(VerifyField($node->field_show_city['und'][0]['value'])): ?>
        <input title="City" type="text" id="f5" name="City" class="<?php if(VerifyField($node->field_require_city['und'][0]['value'])): ?>required <?php endif; ?> salsa_city" placeholder="City">';
        <?php endif; ?>

        <input title="Zip Code" type="text" id="f1" name="Zip" class="required blockInput salsa_zip" value="" maxlength="10" placeholder="Zip Code">


        <?php if(VerifyField($node->field_show_country['und'][0]['value'])): ?>
        <select id="f7" name="Country" class="<?php if(VerifyField($node->field_require_country['und'][0]['value'])): ?>required <?php endif; ?> salsa_country">
            <option selected disabled class="dim" value="">Select Country</option>
            <option value="US">United States</option>
            <option value="AF">Afghanistan</option>
            <option value="AL">Albania</option>
            <option value="DZ">Algeria</option>
            <option value="AS">American Samoa</option>
            <option value="AD">Andorra</option>
            <option value="AO">Angola</option>
            <option value="AI">Anguilla</option>
            <option value="AQ">Antarctica</option>
            <option value="AG">Antigua and Barbuda</option>
            <option value="AR">Argentina</option>
            <option value="AM">Armenia</option>
            <option value="AW">Aruba</option>
            <option value="AU">Australia</option>
            <option value="AT">Austria</option>
            <option value="AZ">Azerbaijan</option>
            <option value="BS">Bahamas</option>
            <option value="BH">Bahrain</option>
            <option value="BD">Bangladesh</option>
            <option value="BB">Barbados</option>
            <option value="BY">Belarus</option>
            <option value="BE">Belgium</option>
            <option value="BZ">Belize</option>
            <option value="BJ">Benin</option>
            <option value="BM">Bermuda</option>
            <option value="BT">Bhutan</option>
            <option value="BO">Bolivia</option>
            <option value="BA">Bosnia and Herzegovina</option>
            <option value="BW">Botswana</option>
            <option value="BV">Bouvet Island</option>
            <option value="BR">Brazil</option>
            <option value="IO">British Indian Ocean Territory</option>
            <option value="BN">Brunei Darussalam</option>
            <option value="BG">Bulgaria</option>
            <option value="BF">Burkina Faso</option>
            <option value="BI">Burundi</option>
            <option value="KH">Cambodia</option>
            <option value="CM">Cameroon</option>
            <option value="CA">Canada</option>
            <option value="CV">Cape Verde</option>
            <option value="KY">Cayman Islands</option>
            <option value="CF">Central African Republic</option>
            <option value="TD">Chad</option>
            <option value="CL">Chile</option>
            <option value="CN">China</option>
            <option value="CX">Christmas Island</option>
            <option value="CC">Cocos (Keeling) Islands</option>
            <option value="CO">Colombia</option>
            <option value="KM">Comoros</option>
            <option value="CG">Congo</option>
            <option value="CD">Congo, The Democratic Republic of the</option>
            <option value="CK">Cook Islands</option>
            <option value="CR">Costa Rica</option>
            <option value="CI">Cote D\'Ivoire</option>
            <option value="HR">Croatia</option>
            <option value="CU">Cuba</option>
            <option value="CW">Curacao</option>
            <option value="CY">Cyprus</option>
            <option value="CZ">Czech Republic</option>
            <option value="DK">Denmark</option>
            <option value="DJ">Djibouti</option>
            <option value="DM">Dominica</option>
            <option value="DO">Dominican Republic</option>
            <option value="TL">East Timor</option>
            <option value="EC">Ecuador</option>
            <option value="EG">Egypt</option>
            <option value="SV">El Salvador</option>
            <option value="GQ">Equatorial Guinea</option>
            <option value="ER">Eritrea</option>
            <option value="EE">Estonia</option>
            <option value="ET">Ethiopia</option>
            <option value="FK">Falkland Islands (Malvinas)</option>
            <option value="FO">Faroe Islands</option>
            <option value="FJ">Fiji</option>
            <option value="FI">Finland</option>
            <option value="FR">France</option>
            <option value="FX">France, Metropolitan</option>
            <option value="GF">French Guiana</option>
            <option value="PF">French Polynesia</option>
            <option value="TF">French Southern Territories</option>
            <option value="GA">Gabon</option>
            <option value="GM">Gambia</option>
            <option value="GE">Georgia</option>
            <option value="DE">Germany</option>
            <option value="GH">Ghana</option>
            <option value="GI">Gibraltar</option>
            <option value="GR">Greece</option>
            <option value="GL">Greenland</option>
            <option value="GD">Grenada</option>
            <option value="GP">Guadeloupe</option>
            <option value="GU">Guam</option>
            <option value="GT">Guatemala</option>
            <option value="GN">Guinea</option>
            <option value="GW">Guinea-Bissau</option>
            <option value="GY">Guyana</option>
            <option value="HT">Haiti</option>
            <option value="HM">Heard and McDonald Islands</option>
            <option value="VA">Holy See (Vatican City State)</option>
            <option value="HN">Honduras</option>
            <option value="HK">Hong Kong</option>
            <option value="HU">Hungary</option>
            <option value="IS">Iceland</option>
            <option value="IN">India</option>
            <option value="ID">Indonesia</option>
            <option value="IR">Iran, Islamic Republic of</option>
            <option value="IQ">Iraq</option>
            <option value="IE">Ireland</option>
            <option value="IL">Israel</option>
            <option value="IT">Italy</option>
            <option value="JM">Jamaica</option>
            <option value="JP">Japan</option>
            <option value="JO">Jordan</option>
            <option value="KZ">Kazakhstan</option>
            <option value="KE">Kenya</option>
            <option value="KI">Kiribati</option>
            <option value="KP">Korea, Dem. People\'s Republic of</option>
            <option value="KR">Korea, Republic of</option>
            <option value="KW">Kuwait</option>
            <option value="KG">Kyrgyzstan</option>
            <option value="LA">Lao People\'s Democratic Republic</option>
            <option value="LV">Latvia</option>
            <option value="LB">Lebanon</option>
            <option value="LS">Lesotho</option>
            <option value="LR">Liberia</option>
            <option value="LY">Libyan Arab Jamahiriya</option>
            <option value="LI">Liechtenstein</option>
            <option value="LT">Lithuania</option>
            <option value="LU">Luxembourg</option>
            <option value="MO">Macao</option>
            <option value="MK">Macedonia, Former Yugoslav Republic</option>
            <option value="MG">Madagascar</option>
            <option value="MW">Malawi</option>
            <option value="MY">Malaysia</option>
            <option value="MV">Maldives</option>
            <option value="ML">Mali</option>
            <option value="MT">Malta</option>
            <option value="MH">Marshall Islands</option>
            <option value="MQ">Martinique</option>
            <option value="MR">Mauritania</option>
            <option value="MU">Mauritius</option>
            <option value="YT">Mayotte</option>
            <option value="MX">Mexico</option>
            <option value="FM">Micronesia, Federated States of</option>
            <option value="MD">Moldova, Republic of</option>
            <option value="MC">Monaco</option>
            <option value="MN">Mongolia</option>
            <option value="MS">Montserrat</option>
            <option value="MA">Morocco</option>
            <option value="MZ">Mozambique</option>
            <option value="MM">Myanmar</option>
            <option value="NA">Namibia</option>
            <option value="NR">Nauru</option>
            <option value="NP">Nepal</option>
            <option value="NL">Netherlands</option>
            <option value="NC">New Caledonia</option>
            <option value="NZ">New Zealand</option>
            <option value="NI">Nicaragua</option>
            <option value="NE">Niger</option>
            <option value="NG">Nigeria</option>
            <option value="NU">Niue</option>
            <option value="NF">Norfolk Island</option>
            <option value="MP">Northern Mariana Islands</option>
            <option value="NO">Norway</option>
            <option value="OM">Oman</option>
            <option value="PK">Pakistan</option>
            <option value="PW">Palau</option>
            <option value="PS">Palestinian Territory, Occupied</option>
            <option value="PA">Panama</option>
            <option value="PG">Papua New Guinea</option>
            <option value="PY">Paraguay</option>
            <option value="PE">Peru</option>
            <option value="PH">Philippines</option>
            <option value="PN">Pitcairn</option>
            <option value="PL">Poland</option>
            <option value="PT">Portugal</option>
            <option value="PR">Puerto Rico</option>
            <option value="QA">Qatar</option>
            <option value="RE">Reunion</option>
            <option value="RO">Romania</option>
            <option value="RU">Russian Federation</option>
            <option value="RW">Rwanda</option>
            <option value="SH">Saint Helena</option>
            <option value="KN">Saint Kitts and Nevis</option>
            <option value="LC">Saint Lucia</option>
            <option value="PM">Saint Pierre and Miquelon</option>
            <option value="VC">Saint Vincent and the Grenadines</option>
            <option value="WS">Samoa</option>
            <option value="SM">San Marino</option>
            <option value="ST">Sao Tome and Principe</option>
            <option value="SA">Saudi Arabia</option>
            <option value="SN">Senegal</option>
            <option value="SP">Serbia</option>
            <option value="SC">Seychelles</option>
            <option value="SL">Sierra Leone</option>
            <option value="SG">Singapore</option>
            <option value="SX">Sint Maarten</option>
            <option value="SK">Slovakia</option>
            <option value="SI">Slovenia</option>
            <option value="SB">Solomon Islands</option>
            <option value="SO">Somalia</option>
            <option value="ZA">South Africa</option>
            <option value="SS">South Sudan</option>
            <option value="GS">S. Georgia and S. Sandwich Islands</option>
            <option value="ES">Spain</option>
            <option value="LK">Sri Lanka</option>
            <option value="SD">Sudan</option>
            <option value="SR">Suriname</option>
            <option value="SJ">Svalbard and Jan Mayen</option>
            <option value="SZ">Swaziland</option>
            <option value="SE">Sweden</option>
            <option value="CH">Switzerland</option>
            <option value="SY">Syrian Arab Republic</option>
            <option value="TW">Taiwan</option>
            <option value="TJ">Tajikistan</option>
            <option value="TZ">Tanzania, United Republic of</option>
            <option value="TH">Thailand</option>
            <option value="TG">Togo</option>
            <option value="TK">Tokelau</option>
            <option value="TO">Tonga</option>
            <option value="TT">Trinidad and Tobago</option>
            <option value="TN">Tunisia</option>
            <option value="TR">Turkey</option>
            <option value="TM">Turkmenistan</option>
            <option value="TC">Turks and Caicos Islands</option>
            <option value="TV">Tuvalu</option>
            <option value="UG">Uganda</option>
            <option value="UA">Ukraine</option>
            <option value="AE">United Arab Emirates</option>
            <option value="GB">United Kingdom</option>
            <option value="UM">United States Outlying Islands</option>
            <option value="UY">Uruguay</option>
            <option value="UZ">Uzbekistan</option>
            <option value="VU">Vanuatu</option>
            <option value="VE">Venezuela</option>
            <option value="VN">Vietnam</option>
            <option value="VG">Virgin Islands, British</option>
            <option value="VI">Virgin Islands, U.S.</option>
            <option value="WF">Wallis and Futuna</option>
            <option value="EH">Western Sahara</option>
            <option value="YE">Yemen</option>
            <option value="YU">Yugoslavia</option>
            <option value="ZR">Zaire</option>
            <option value="ZM">Zambia</option>
            <option value="ZW">Zimbabwe</option>
        </select>';
        <?php endif; ?>
        
        <?php if(VerifyField($node->field_show_comments['und'][0]['value'])): ?>
        <textarea name="Comment" id="Comment" rows="4" cols="40" placeholder="Comments" class="<?php if(VerifyField($node->field_require_comments['und'][0]['value'])): ?>required <?php endif; ?>"></textarea>
        <?php endif; ?>

          <label for="Anonymous">
          <input type="checkbox" class="checkbox" name="Anonymous" id="Anonymous" value="1">
          Don't show my name</label>
        <style>
          .memberCode{display:none;}
        </style>
        
        <div class="memberCode"> Optional Member Code
        <input name="first_name_6461" value=""/>
        </div>
        <input type="hidden" name="link" value="groups"/>
        <input type="hidden" name="linkKey" value="11"/>
        <input type="hidden" name="link" value="action"/>
        <!-- This is where you put the action_KEY for your petition. -->
        <input type="hidden" name="linkKey" value="<?php print $p_actionKey ?>"/>
        <input type="hidden" name="redirect" value="<?php print render($content['field_redirect']['#items']['0']['url']); ?>">    
        <input type="Submit" value="sign" class="btn btn-default" /> 
      </form>

      </div> <!-- /#action_action -->
  
  </div> <!-- .left-col -->

    
  <div class="col-sm-6 col-xs-12 rightcol col-sm-pull-6">
    
      <div id="action_content">
       <div class="action-body content clearfix"<?php print $content_attributes; ?>>
       
        <?php
      // We hide the comments and links now so that we can render them later.
        hide($content['comments']);
        hide($content['links']);
        hide($content['field_org_logo']);
        hide($content['field_action_img']);
        hide($content['field_share_facebook_fixed']);
        hide($content['field_share_twitter_fixed']);
        hide($content['field_share_digg_fixed']);
        hide($content['field_share_stumble_fixed']);
        hide($content['field_share_reddit_fixed']);
        hide($content['field_action_cta']);
        hide($content['field_action_featured']);
        hide($content['field_salsa_link']);
        hide($content['field_email_trigger_keys']);
        hide($content['field_redirect']);
        hide($content['field_org_tagline']);
        hide($content['field_org_name']);
        hide($content['field_action_title']);
        hide($content['field_show_extra_fields']);
        hide($content['field_show_bg']);
        hide($content['field_show_headline_and_shares']);
	  
      print render($content);
      ?>
      </div> <!-- /.action-body -->
    </div> <!-- /.action_content -->

                    
  </div> <!-- .col-xs-3 --> 
</div> <!-- .row -->



<div class="row">
  <div class="col-xs-12 padtop-most">

    <script>
    jQuery(document).ready(function ($) { 
    // drupal wrap for namespace
    $(document).ready(function () {
       // focus form
     //$("input:text:visible:first").focus();
        //
    var sigCount;
    var commentSet = 25;
    var trackCtr = commentSet;
    var sigCountChipAway;
    var actionKey = '<?php print $p_actionKey ?>';
    <?php /* console.log("actionKey = "+actionKey);
        // THIS WORKS!!!!
        //var sigURL = encodeURIComponent('http://salsa.wiredforchange.com/o/6461/p/dia/action3/common/public/?action_KEY=' + actionKey + '&start=' + trackCtr) + ' .signatures'; */ ?>
    var sigURL = '<?php print $GLOBALS['base_url'] . base_path() . path_to_theme() ?>/sp.php?mode=native&url=';
        $("#comment_loader").click(function () {
        //console.log("sigCount: "+sigCount+", trackCtr + commentSet: "+(trackCtr + commentSet)+",trackCtr: "+(trackCtr)+", commentSet: "+(commentSet));
        trackCtr += commentSet;
        if (trackCtr < (sigCount-commentSet)) {
            //if((sigCount) > (trackCtr+24)) {
          //console.log("preclick: sigCount = "+sigCount+", trackCtr = "+trackCtr+", sigCountChipAway = "+sigCountChipAway);
          $('.adminlist').addClass('dim');
          sigCountChipAway -= commentSet;
                $("#petition_signers").load(sigURL + encodeURIComponent('http://salsa.wiredforchange.com/o/6461/p/dia/action3/common/public/?action_KEY=' + actionKey + '&start=' + trackCtr)+' .signatures', function () {
          //console.log("postclick: sigCount = "+sigCount+", trackCtr = "+trackCtr+", sigCountChipAway = "+sigCountChipAway);
          //console.log("Click load");
          $('.adminlist').removeClass('dim');
                });
            } else {
                $(this).off().text("There are no more comments.").addClass('dim');
            }
        });
        //
        $("#petition_signers").load('<?php print $GLOBALS['base_url'] . base_path() . path_to_theme() ?>/sp.php?mode=native&url=http://salsa.wiredforchange.com/o/6461/p/dia/action3/common/public/?action_KEY=' + actionKey + ' .signatures', function () {
            //console.log("Initial load");
            var sigCountToTrim = $("#petition_signers .signatures > .number").text(); // string that contains total sigs
            var sigCountArray = sigCountToTrim.split(' '); // create array from split
            sigCount = sigCountArray[1]; // just the sig total
        sigCountChipAway = sigCount;
            //trackCtr = 0;
        });
        //
          $("#actionfooter").load('<?php print $GLOBALS['base_url'] . base_path() . path_to_theme() ?>/sp.php?mode=native&url=http://salsa.wiredforchange.com/o/6461/p/dia/action3/common/public/?action_KEY=' + actionKey + ' #actionfooter', function () {
            //console.log("Footer load");
        })
      //
    });

    //
    });
    </script>
     
      <h3 class="flush-top text-center text-md-left info">Other voices</h3>
      <div id="petition_signers">loading...</div>
      <div id="comment_loader">More comments</div>
      <div id="actionfooter">loading...</div>  
    
        
  </div>
</div>
<?php //include 'footer.php';?>