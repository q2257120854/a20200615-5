<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
		<title>注册 - {$c['网站名称']}</title>

		<link href="{$templatedir}/style/css/all.min-40cb1e.css" rel="stylesheet">
		<link href="{$templatedir}/style/css/custom.css" rel="stylesheet">
		<link href="{$templatedir}/style/css/all.min.css" rel="stylesheet">
		<link rel="icon"href="{$templatedir}/favicon.ico">
		<!--[if lt IE 9]>
  <script src="{$templatedir}/style/js/html5shiv.js"></script>
  <script src="{$templatedir}/style/js/respond.min.js"></script>
<![endif]-->
		<script src="{$templatedir}/style/js/scripts.min-40cb1e.js"></script>
		<link rel="stylesheet" href="{$templatedir}/style/css/bootstrap.min.css">
		<link rel="stylesheet" id="css-main" href="{$templatedir}/style/css/oneui.css">


		<link rel="stylesheet" type="text/css" href="{$templatedir}/style/css/fontawesome-all.min.css">
             <script src="{$templatedir}/gt/gt.js"></script>
		{$plug['HEAD区域']}
	</head>

	<body data-phone-cc-input="1" style="background-color: #F5F5F5;">
	    	{include file="alert.tpl"}
		<link rel="stylesheet" href="{$templatedir}/style/css/bootstrap.min.css">
		<link rel="stylesheet" id="css-main" href="{$templatedir}/style/css/oneui.css">

		<div class="bg-white pulldown" style="top: 0px;">
			<div class="content content-boxed overflow-hidden">
				<div class="row">
					<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
						<div class="push-30-t push-50 animated fadeIn">
							<div class="text-center">
                                <img src="{$templatedir}/logo2.png" widht="122" height="44" /> 
							</div>
<br/>	
							<section id="main-body">
								<div class="main-content">
									<p class="text-center text-muted">
										用户注册
									</p>
									<h1 class="h3 text-center" style="color: #656565;">Create Account</h1>

<style>
#nr{
    font-size:15px;
    margin: 0;
    background: -webkit-linear-gradient(left,
        #ffffff,
        #ff0000 6.25%,
        #ff7d00 12.5%,
        #ffff00 18.75%,
        #00ff00 25%,
        #00ffff 31.25%,
        #0000ff 37.5%,
        #ff00ff 43.75%,
        #ffff00 50%,
        #ff0000 56.25%,
        #ff7d00 62.5%,
        #ffff00 68.75%,
        #00ff00 75%,
        #00ffff 81.25%,
        #0000ff 87.5%,
        #ff00ff 93.75%,
        #ffff00 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-size: 200% 100%;
    animation: masked-animation 3s infinite linear;
}
@keyframes masked-animation {
    0% {
        background-position: 0 0;
    }
    100% {
        background-position: -100%, 0;
    }
}
</style>
<br/>




									<script type="text/javascript" src="{$templatedir}/style/js/StatesDropdown.js"></script>
									<script type="text/javascript" src="{$templatedir}/style/js/PasswordStrength.js"></script>
						<script>
									window.langPasswordStrength = "密码强度（请务必使用复杂密码）";
                                        window.langPasswordWeak = "弱（请务必使用复杂密码以提高安全性）";
                                        window.langPasswordModerate = "一般（请尽量使用复杂密码以提高安全性）";
                                        window.langPasswordStrong = "安全（请您妥善保管您的密码）";
                                        jQuery(document).ready(function()
                                        {
                                        jQuery("#inputNewPassword1").keyup(registerFormPasswordStrengthFeedback);
                                        });
                                    </script>
                                    
                                    
									<form method="post" class="js-validation-register form-horizontal push-30-t push-50 using-password-strength" action="" >
									    
										
							<input name="address" type="hidden" id="address" value="中国"  />
										
										
										<div id="containerNewUserSignup">
											<div class="form-group">
												<div class="col-xs-6">
													<div class="form-material form-material-success floating">
														
														<input id="username" name="username" type="text" class="form-control"  required="" value=""/>
														<label for="username" style="color: #767676;">用户名</label>
													</div>
												</div>
												
												<div class="col-xs-6">
													<div class="form-material form-material-success floating">
														
														<input name="name" type="text" id="name"  class="field form-control" value="" required=""/>
														
														
														<label for="name" style="color: #767676;">姓名</label>
													</div>
												</div>
												
											</div>

											<div class="form-group">
												<div class="col-xs-12">
													<div class="form-material form-material-success floating">
														<input name="zip"  type="text" id="zip" class="form-control" value=""/>
														<label for="zip" style="color: #767676;">腾讯QQ</label>
													</div>
												</div>
											</div>


											<div class="form-group">
												<div class="col-xs-12">
													<div class="form-material form-material-success floating">
														<input name="email" type="text" id="email" class="form-control" value=""/>
														<label for="email" style="color: #767676;">邮件地址</label>
													</div>
												</div>
											</div>

											<div class="form-group">
												<div class="col-xs-12">
													<div class="form-material form-material-success floating">
														<input name="phone" type="text" id="phone" class="form-control" value="" />
														<label for="phone" style="color: #767676;"></label>
													</div>
												</div>
											</div>
											<div style="display: none;">
												
												<div class="form-group">
													<div class="col-xs-12">
														<select name="country" id="inputCountry" class="form-control">
															<option value="AF">
																Afghanistan
															</option>
															<option value="AX">
																Aland Islands
															</option>
															<option value="AL">
																Albania
															</option>
															<option value="DZ">
																Algeria
															</option>
															<option value="AS">
																American Samoa
															</option>
															<option value="AD">
																Andorra
															</option>
															<option value="AO">
																Angola
															</option>
															<option value="AI">
																Anguilla
															</option>
															<option value="AQ">
																Antarctica
															</option>
															<option value="AG">
																Antigua And Barbuda
															</option>
															<option value="AR">
																Argentina
															</option>
															<option value="AM">
																Armenia
															</option>
															<option value="AW">
																Aruba
															</option>
															<option value="AU">
																Australia
															</option>
															<option value="AT">
																Austria
															</option>
															<option value="AZ">
																Azerbaijan
															</option>
															<option value="BS">
																Bahamas
															</option>
															<option value="BH">
																Bahrain
															</option>
															<option value="BD">
																Bangladesh
															</option>
															<option value="BB">
																Barbados
															</option>
															<option value="BY">
																Belarus
															</option>
															<option value="BE">
																Belgium
															</option>
															<option value="BZ">
																Belize
															</option>
															<option value="BJ">
																Benin
															</option>
															<option value="BM">
																Bermuda
															</option>
															<option value="BT">
																Bhutan
															</option>
															<option value="BO">
																Bolivia
															</option>
															<option value="BA">
																Bosnia And Herzegovina
															</option>
															<option value="BW">
																Botswana
															</option>
															<option value="BV">
																Bouvet Island
															</option>
															<option value="BR">
																Brazil
															</option>
															<option value="IO">
																British Indian Ocean Territory
															</option>
															<option value="BN">
																Brunei Darussalam
															</option>
															<option value="BG">
																Bulgaria
															</option>
															<option value="BF">
																Burkina Faso
															</option>
															<option value="BI">
																Burundi
															</option>
															<option value="KH">
																Cambodia
															</option>
															<option value="CM">
																Cameroon
															</option>
															<option value="CA">
																Canada
															</option>
															<option value="CV">
																Cape Verde
															</option>
															<option value="KY">
																Cayman Islands
															</option>
															<option value="CF">
																Central African Republic
															</option>
															<option value="TD">
																Chad
															</option>
															<option value="CL">
																Chile
															</option>
															<option value="CN" selected="selected">
																China
															</option>
															<option value="CX">
																Christmas Island
															</option>
															<option value="CC">
																Cocos (Keeling) Islands
															</option>
															<option value="CO">
																Colombia
															</option>
															<option value="KM">
																Comoros
															</option>
															<option value="CG">
																Congo
															</option>
															<option value="CD">
																Congo, Democratic Republic
															</option>
															<option value="CK">
																Cook Islands
															</option>
															<option value="CR">
																Costa Rica
															</option>
															<option value="CI">
																Cote D'Ivoire
															</option>
															<option value="HR">
																Croatia
															</option>
															<option value="CU">
																Cuba
															</option>
															<option value="CW">
																Curacao
															</option>
															<option value="CY">
																Cyprus
															</option>
															<option value="CZ">
																Czech Republic
															</option>
															<option value="DK">
																Denmark
															</option>
															<option value="DJ">
																Djibouti
															</option>
															<option value="DM">
																Dominica
															</option>
															<option value="DO">
																Dominican Republic
															</option>
															<option value="EC">
																Ecuador
															</option>
															<option value="EG">
																Egypt
															</option>
															<option value="SV">
																El Salvador
															</option>
															<option value="GQ">
																Equatorial Guinea
															</option>
															<option value="ER">
																Eritrea
															</option>
															<option value="EE">
																Estonia
															</option>
															<option value="ET">
																Ethiopia
															</option>
															<option value="FK">
																Falkland Islands (Malvinas)
															</option>
															<option value="FO">
																Faroe Islands
															</option>
															<option value="FJ">
																Fiji
															</option>
															<option value="FI">
																Finland
															</option>
															<option value="FR">
																France
															</option>
															<option value="GF">
																French Guiana
															</option>
															<option value="PF">
																French Polynesia
															</option>
															<option value="TF">
																French Southern Territories
															</option>
															<option value="GA">
																Gabon
															</option>
															<option value="GM">
																Gambia
															</option>
															<option value="GE">
																Georgia
															</option>
															<option value="DE">
																Germany
															</option>
															<option value="GH">
																Ghana
															</option>
															<option value="GI">
																Gibraltar
															</option>
															<option value="GR">
																Greece
															</option>
															<option value="GL">
																Greenland
															</option>
															<option value="GD">
																Grenada
															</option>
															<option value="GP">
																Guadeloupe
															</option>
															<option value="GU">
																Guam
															</option>
															<option value="GT">
																Guatemala
															</option>
															<option value="GG">
																Guernsey
															</option>
															<option value="GN">
																Guinea
															</option>
															<option value="GW">
																Guinea-Bissau
															</option>
															<option value="GY">
																Guyana
															</option>
															<option value="HT">
																Haiti
															</option>
															<option value="HM">
																Heard Island & Mcdonald Islands
															</option>
															<option value="VA">
																Holy See (Vatican City State)
															</option>
															<option value="HN">
																Honduras
															</option>
															<option value="HK">
																Hong Kong
															</option>
															<option value="HU">
																Hungary
															</option>
															<option value="IS">
																Iceland
															</option>
															<option value="IN">
																India
															</option>
															<option value="ID">
																Indonesia
															</option>
															<option value="IR">
																Iran, Islamic Republic Of
															</option>
															<option value="IQ">
																Iraq
															</option>
															<option value="IE">
																Ireland
															</option>
															<option value="IM">
																Isle Of Man
															</option>
															<option value="IL">
																Israel
															</option>
															<option value="IT">
																Italy
															</option>
															<option value="JM">
																Jamaica
															</option>
															<option value="JP">
																Japan
															</option>
															<option value="JE">
																Jersey
															</option>
															<option value="JO">
																Jordan
															</option>
															<option value="KZ">
																Kazakhstan
															</option>
															<option value="KE">
																Kenya
															</option>
															<option value="KI">
																Kiribati
															</option>
															<option value="KR">
																Korea
															</option>
															<option value="KW">
																Kuwait
															</option>
															<option value="KG">
																Kyrgyzstan
															</option>
															<option value="LA">
																Lao People's Democratic Republic
															</option>
															<option value="LV">
																Latvia
															</option>
															<option value="LB">
																Lebanon
															</option>
															<option value="LS">
																Lesotho
															</option>
															<option value="LR">
																Liberia
															</option>
															<option value="LY">
																Libyan Arab Jamahiriya
															</option>
															<option value="LI">
																Liechtenstein
															</option>
															<option value="LT">
																Lithuania
															</option>
															<option value="LU">
																Luxembourg
															</option>
															<option value="MO">
																Macao
															</option>
															<option value="MK">
																Macedonia
															</option>
															<option value="MG">
																Madagascar
															</option>
															<option value="MW">
																Malawi
															</option>
															<option value="MY">
																Malaysia
															</option>
															<option value="MV">
																Maldives
															</option>
															<option value="ML">
																Mali
															</option>
															<option value="MT">
																Malta
															</option>
															<option value="MH">
																Marshall Islands
															</option>
															<option value="MQ">
																Martinique
															</option>
															<option value="MR">
																Mauritania
															</option>
															<option value="MU">
																Mauritius
															</option>
															<option value="YT">
																Mayotte
															</option>
															<option value="MX">
																Mexico
															</option>
															<option value="FM">
																Micronesia, Federated States Of
															</option>
															<option value="MD">
																Moldova
															</option>
															<option value="MC">
																Monaco
															</option>
															<option value="MN">
																Mongolia
															</option>
															<option value="ME">
																Montenegro
															</option>
															<option value="MS">
																Montserrat
															</option>
															<option value="MA">
																Morocco
															</option>
															<option value="MZ">
																Mozambique
															</option>
															<option value="MM">
																Myanmar
															</option>
															<option value="NA">
																Namibia
															</option>
															<option value="NR">
																Nauru
															</option>
															<option value="NP">
																Nepal
															</option>
															<option value="NL">
																Netherlands
															</option>
															<option value="AN">
																Netherlands Antilles
															</option>
															<option value="NC">
																New Caledonia
															</option>
															<option value="NZ">
																New Zealand
															</option>
															<option value="NI">
																Nicaragua
															</option>
															<option value="NE">
																Niger
															</option>
															<option value="NG">
																Nigeria
															</option>
															<option value="NU">
																Niue
															</option>
															<option value="NF">
																Norfolk Island
															</option>
															<option value="MP">
																Northern Mariana Islands
															</option>
															<option value="NO">
																Norway
															</option>
															<option value="OM">
																Oman
															</option>
															<option value="PK">
																Pakistan
															</option>
															<option value="PW">
																Palau
															</option>
															<option value="PS">
																Palestine, State of
															</option>
															<option value="PA">
																Panama
															</option>
															<option value="PG">
																Papua New Guinea
															</option>
															<option value="PY">
																Paraguay
															</option>
															<option value="PE">
																Peru
															</option>
															<option value="PH">
																Philippines
															</option>
															<option value="PN">
																Pitcairn
															</option>
															<option value="PL">
																Poland
															</option>
															<option value="PT">
																Portugal
															</option>
															<option value="PR">
																Puerto Rico
															</option>
															<option value="QA">
																Qatar
															</option>
															<option value="RE">
																Reunion
															</option>
															<option value="RO">
																Romania
															</option>
															<option value="RU">
																Russian Federation
															</option>
															<option value="RW">
																Rwanda
															</option>
															<option value="BL">
																Saint Barthelemy
															</option>
															<option value="SH">
																Saint Helena
															</option>
															<option value="KN">
																Saint Kitts And Nevis
															</option>
															<option value="LC">
																Saint Lucia
															</option>
															<option value="MF">
																Saint Martin
															</option>
															<option value="PM">
																Saint Pierre And Miquelon
															</option>
															<option value="VC">
																Saint Vincent And Grenadines
															</option>
															<option value="WS">
																Samoa
															</option>
															<option value="SM">
																San Marino
															</option>
															<option value="ST">
																Sao Tome And Principe
															</option>
															<option value="SA">
																Saudi Arabia
															</option>
															<option value="SN">
																Senegal
															</option>
															<option value="RS">
																Serbia
															</option>
															<option value="SC">
																Seychelles
															</option>
															<option value="SL">
																Sierra Leone
															</option>
															<option value="SG">
																Singapore
															</option>
															<option value="SK">
																Slovakia
															</option>
															<option value="SI">
																Slovenia
															</option>
															<option value="SB">
																Solomon Islands
															</option>
															<option value="SO">
																Somalia
															</option>
															<option value="ZA">
																South Africa
															</option>
															<option value="GS">
																South Georgia And Sandwich Isl.
															</option>
															<option value="ES">
																Spain
															</option>
															<option value="LK">
																Sri Lanka
															</option>
															<option value="SD">
																Sudan
															</option>
															<option value="SR">
																Suriname
															</option>
															<option value="SJ">
																Svalbard And Jan Mayen
															</option>
															<option value="SZ">
																Swaziland
															</option>
															<option value="SE">
																Sweden
															</option>
															<option value="CH">
																Switzerland
															</option>
															<option value="SY">
																Syrian Arab Republic
															</option>
															<option value="TW">
																Taiwan
															</option>
															<option value="TJ">
																Tajikistan
															</option>
															<option value="TZ">
																Tanzania
															</option>
															<option value="TH">
																Thailand
															</option>
															<option value="TL">
																Timor-Leste
															</option>
															<option value="TG">
																Togo
															</option>
															<option value="TK">
																Tokelau
															</option>
															<option value="TO">
																Tonga
															</option>
															<option value="TT">
																Trinidad And Tobago
															</option>
															<option value="TN">
																Tunisia
															</option>
															<option value="TR">
																Turkey
															</option>
															<option value="TM">
																Turkmenistan
															</option>
															<option value="TC">
																Turks And Caicos Islands
															</option>
															<option value="TV">
																Tuvalu
															</option>
															<option value="UG">
																Uganda
															</option>
															<option value="UA">
																Ukraine
															</option>
															<option value="AE">
																United Arab Emirates
															</option>
															<option value="GB">
																United Kingdom
															</option>
															<option value="US">
																United States
															</option>
															<option value="UM">
																United States Outlying Islands
															</option>
															<option value="UY">
																Uruguay
															</option>
															<option value="UZ">
																Uzbekistan
															</option>
															<option value="VU">
																Vanuatu
															</option>
															<option value="VE">
																Venezuela
															</option>
															<option value="VN">
																Viet Nam
															</option>
															<option value="VG">
																Virgin Islands, British
															</option>
															<option value="VI">
																Virgin Islands, U.S.
															</option>
															<option value="WF">
																Wallis And Futuna
															</option>
															<option value="EH">
																Western Sahara
															</option>
															<option value="YE">
																Yemen
															</option>
															<option value="ZM">
																Zambia
															</option>
															<option value="ZW">
																Zimbabwe
															</option>
														</select>
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-12">
													<select name="country" id="country" class="form-control" >
                                                     {foreach from=$countrys item=country}
			                                        <option value="{$country}"{if $c['默认国家']==$country} selected="selected"{/if}>{$country}</option>
                                                    {/foreach}
                                                    </select>
												</div>
											</div>
											<div id="containerNewUserSecurity">
												<div id="containerPassword" class="">
													<div id="passwdFeedback" style="display: none;" class="alert alert-info text-center col-sm-12"></div>
													<div class="form-group">
														<div class="col-xs-12">
															<div class="form-material form-material-primary floating">
															    
																 <input id="inputNewPassword1" name="password" type="password" data-error-threshold="50"
																 data-warning-threshold="75" class="form-control" autocomplete="off" />
																 
																<label for="inputNewPassword1" style="color: #767676;">密码</label>
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="col-xs-12" style="margin-bottom: -15px;">
															<div class="form-material form-material-primary floating">
																
																<input id="inputNewPassword2" name="repassword" type="password" class="form-control" autocomplete="off" />
																
																<label for="inputNewPassword2" style="color: #767676;">确认密码</label>
															</div>
														</div>
													</div>
													<div class="progress" style="margin-bottom: 35px;">
														<div class="progress-bar progress-bar-success progress-bar-striped" role="password" aria-valuenow="0"
														 aria-valuemin="0" aria-valuemax="100" id="passwordStrengthMeterBar">
														</div>
													</div>
												</div>
											</div>
											
											<div class="form-group">
												<div class="col-xs-7 col-sm-8">
													<label class="css-input switch switch-sm switch-success">
														<input type="checkbox" name="accepttos"><span></span> 注册表示同意该服务条款
													</label>
												</div>
												<div class="col-xs-5 col-sm-4">
													<div class="font-s13 text-right push-5-t">
														<a href="https://www.rlzml.cn/index.php/index/announcement/7/" target="_blank" style="color: #00AAFF;">服务条款</a>
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-12 col-sm-6 col-sm-offset-3">
													<button class="btn btn-sm btn-block btn-primary" type="submit">注册</button>
													
												</div>
											</div>
										</div>
									</form>
									<p style="text-align:center;">已有账号？ <a href="{$ROOT}/index/login/" target="_blank">登录</a></p>
								</div>
							</section>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="push-30-t text-center">
			<small class="text-muted"><span class="js-year-copy"></span> &copy; Copyright 2020 {$c['网站名称']} , All Rights Reserved</small>
		</div>
		<script src="{$templatedir}/style/js/jquery.slimscroll.min.js"></script>
		<script src="{$templatedir}/style/js/jquery.scrollLock.min.js"></script>
		<script src="{$templatedir}/style/js/jquery.appear.min.js"></script>
		<script src="{$templatedir}/style/js/jquery.countTo.min.js"></script>
		<script src="{$templatedir}/style/js/jquery.placeholder.min.js"></script>
		<script src="{$templatedir}/style/js/js.cookie.min.js"></script>
		<script src="{$templatedir}/style/js/app.js"></script>
		<script src="{$templatedir}/style/js/base_pages_login.js"></script>
		<script src="{$templatedir}/style/js/jquery.validate.min.js"></script>
		
	</body>
</html>
