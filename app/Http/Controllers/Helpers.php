<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Helpers extends Controller
{
    
    public $public_page_settings = [
        
        'css'   => [
            
                    '//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.css',
                    '//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css',
                    '//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css',
                    '//maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css',
                    '//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css',
                    '//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css',
                    '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css',
                    '/public/css/app.css'
            
        ],
        'js'    => [
                    
                    '//code.jquery.com/jquery-1.11.3.min.js',
                    // '//code.jquery.com/ui/1.11.3/jquery-ui.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js',
                    '//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.6.8-fix/jquery.nicescroll.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/jStorage/0.4.12/jstorage.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                    '/public/js/app.js',
                    
        ]
    ];
    
    public $admin_page_settings = [
        
        'css'   => [
            
                    '/public/css/theme-default.css',
                    '/public/css/base.css',
                    '/public/css/custom.css',
            
        ],
        'js'    => [
                    
                    '//code.jquery.com/jquery-1.11.3.min.js',
                    '//code.jquery.com/ui/1.11.3/jquery-ui.min.js',
                    '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js',
                    '//cdn.jsdelivr.net/icheck/1.0.2/icheck.min.js',
                    '//cdn.jsdelivr.net/jquery.mcustomscrollbar/3.1.0/jquery.mCustomScrollbar.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.4/raphael-min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js',
                    '/public/js/plugins/rickshaw/d3.v3.js',
                    '//cdnjs.cloudflare.com/ajax/libs/rickshaw/1.5.1/rickshaw.min.js',
                    // '/peerposted/public/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
                    // '/peerposted/public/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
                    '//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.12/daterangepicker.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js',
                    '//cdn.jsdelivr.net/bootstrap.timepicker/0.2.6/js/bootstrap-timepicker.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.4/js/bootstrap-select.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/javascript-canvas-to-blob/2.2.4/js/canvas-to-blob.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.2.8/js/fileinput.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js',
                    '/public/js/plugins/scrolltotop/scrolltopcontrol.js',
                    '//cdnjs.cloudflare.com/ajax/libs/summernote/0.7.3/summernote.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.9.0/validator.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/jquery.lazyloadxt/1.1.0/jquery.lazyloadxt.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js',
                    // '//cdnjs.cloudflare.com/ajax/libs/mousetrap/1.4.6/mousetrap.min.js',
                    // '//cdnjs.cloudflare.com/ajax/libs/jStorage/0.4.12/jstorage.min.js',
                    // '//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js',
                    '/public/js/plugins.js',
                    '/public/js/actions.js',
                    '/public/js/custom.js'
                    
        ]
    ];
    
    
    public $countries = [
        [1, 'code'=>'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4, 93],
        [2, 'code'=>'AL', 'ALBANIA', 'Albania', 'ALB', 8, 355],
        [3, 'code'=>'DZ', 'ALGERIA', 'Algeria', 'DZA', 12, 213],
        [4, 'code'=>'AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16, 1684],
        [5, 'code'=>'AD', 'ANDORRA', 'Andorra', 'AND', 20, 376],
        [6, 'code'=>'AO', 'ANGOLA', 'Angola', 'AGO', 24, 244],
        [7, 'code'=>'AI', 'ANGUILLA', 'Anguilla', 'AIA', 660, 1264],
        [8, 'code'=>'AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL, 0],
        [9, 'code'=>'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28, 1268],
        [10, 'code'=>'AR', 'ARGENTINA', 'Argentina', 'ARG', 32, 54],
        [11, 'code'=>'AM', 'ARMENIA', 'Armenia', 'ARM', 51, 374],
        [12, 'code'=>'AW', 'ARUBA', 'Aruba', 'ABW', 533, 297],
        [13, 'code'=>'AU', 'AUSTRALIA', 'Australia', 'AUS', 36, 61],
        [14, 'code'=>'AT', 'AUSTRIA', 'Austria', 'AUT', 40, 43],
        [15, 'code'=>'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31, 994],
        [16, 'code'=>'BS', 'BAHAMAS', 'Bahamas', 'BHS', 44, 1242],
        [17, 'code'=>'BH', 'BAHRAIN', 'Bahrain', 'BHR', 48, 973],
        [18, 'code'=>'BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50, 880],
        [19, 'code'=>'BB', 'BARBADOS', 'Barbados', 'BRB', 52, 1246],
        [20, 'code'=>'BY', 'BELARUS', 'Belarus', 'BLR', 112, 375],
        [21, 'code'=>'BE', 'BELGIUM', 'Belgium', 'BEL', 56, 32],
        [22, 'code'=>'BZ', 'BELIZE', 'Belize', 'BLZ', 84, 501],
        [23, 'code'=>'BJ', 'BENIN', 'Benin', 'BEN', 204, 229],
        [24, 'code'=>'BM', 'BERMUDA', 'Bermuda', 'BMU', 60, 1441],
        [25, 'code'=>'BT', 'BHUTAN', 'Bhutan', 'BTN', 64, 975],
        [26, 'code'=>'BO', 'BOLIVIA', 'Bolivia', 'BOL', 68, 591],
        [27, 'code'=>'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70, 387],
        [28, 'code'=>'BW', 'BOTSWANA', 'Botswana', 'BWA', 72, 267],
        [29, 'code'=>'BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL, 0],
        [30, 'code'=>'BR', 'BRAZIL', 'Brazil', 'BRA', 76, 55],
        [31, 'code'=>'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL, 246],
        [32, 'code'=>'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96, 673],
        [33, 'code'=>'BG', 'BULGARIA', 'Bulgaria', 'BGR', 100, 359],
        [34, 'code'=>'BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854, 226],
        [35, 'code'=>'BI', 'BURUNDI', 'Burundi', 'BDI', 108, 257],
        [36, 'code'=>'KH', 'CAMBODIA', 'Cambodia', 'KHM', 116, 855],
        [37, 'code'=>'CM', 'CAMEROON', 'Cameroon', 'CMR', 120, 237],
        [38, 'code'=>'CA', 'CANADA', 'Canada', 'CAN', 124, 1],
        [39, 'code'=>'CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132, 238],
        [40, 'code'=>'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136, 1345],
        [41, 'code'=>'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140, 236],
        [42, 'code'=>'TD', 'CHAD', 'Chad', 'TCD', 148, 235],
        [43, 'code'=>'CL', 'CHILE', 'Chile', 'CHL', 152, 56],
        [44, 'code'=>'CN', 'CHINA', 'China', 'CHN', 156, 86],
        [45, 'code'=>'CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL, 61],
        [46, 'code'=>'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL, 672],
        [47, 'code'=>'CO', 'COLOMBIA', 'Colombia', 'COL', 170, 57],
        [48, 'code'=>'KM', 'COMOROS', 'Comoros', 'COM', 174, 269],
        [49, 'code'=>'CG', 'CONGO', 'Congo', 'COG', 178, 242],
        [50, 'code'=>'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180, 242],
        [51, 'code'=>'CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184, 682],
        [52, 'code'=>'CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188, 506],
        [53, 'code'=>'CI', 'COTE D\'IVOIRE', 'Cote D\'Ivoire', 'CIV', 384, 225],
        [54, 'code'=>'HR', 'CROATIA', 'Croatia', 'HRV', 191, 385],
        [55, 'code'=>'CU', 'CUBA', 'Cuba', 'CUB', 192, 53],
        [56, 'code'=>'CY', 'CYPRUS', 'Cyprus', 'CYP', 196, 357],
        [57, 'code'=>'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203, 420],
        [58, 'code'=>'DK', 'DENMARK', 'Denmark', 'DNK', 208, 45],
        [59, 'code'=>'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262, 253],
        [60, 'code'=>'DM', 'DOMINICA', 'Dominica', 'DMA', 212, 1767],
        [61, 'code'=>'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214, 1809],
        [62, 'code'=>'EC', 'ECUADOR', 'Ecuador', 'ECU', 218, 593],
        [63, 'code'=>'EG', 'EGYPT', 'Egypt', 'EGY', 818, 20],
        [64, 'code'=>'SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222, 503],
        [65, 'code'=>'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226, 240],
        [66, 'code'=>'ER', 'ERITREA', 'Eritrea', 'ERI', 232, 291],
        [67, 'code'=>'EE', 'ESTONIA', 'Estonia', 'EST', 233, 372],
        [68, 'code'=>'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231, 251],
        [69, 'code'=>'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238, 500],
        [70, 'code'=>'FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234, 298],
        [71, 'code'=>'FJ', 'FIJI', 'Fiji', 'FJI', 242, 679],
        [72, 'code'=>'FI', 'FINLAND', 'Finland', 'FIN', 246, 358],
        [73, 'code'=>'FR', 'FRANCE', 'France', 'FRA', 250, 33],
        [74, 'code'=>'GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254, 594],
        [75, 'code'=>'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258, 689],
        [76, 'code'=>'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL, 0],
        [77, 'code'=>'GA', 'GABON', 'Gabon', 'GAB', 266, 241],
        [78, 'code'=>'GM', 'GAMBIA', 'Gambia', 'GMB', 270, 220],
        [79, 'code'=>'GE', 'GEORGIA', 'Georgia', 'GEO', 268, 995],
        [80, 'code'=>'DE', 'GERMANY', 'Germany', 'DEU', 276, 49],
        [81, 'code'=>'GH', 'GHANA', 'Ghana', 'GHA', 288, 233],
        [82, 'code'=>'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292, 350],
        [83, 'code'=>'GR', 'GREECE', 'Greece', 'GRC', 300, 30],
        [84, 'code'=>'GL', 'GREENLAND', 'Greenland', 'GRL', 304, 299],
        [85, 'code'=>'GD', 'GRENADA', 'Grenada', 'GRD', 308, 1473],
        [86, 'code'=>'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312, 590],
        [87, 'code'=>'GU', 'GUAM', 'Guam', 'GUM', 316, 1671],
        [88, 'code'=>'GT', 'GUATEMALA', 'Guatemala', 'GTM', 320, 502],
        [89, 'code'=>'GN', 'GUINEA', 'Guinea', 'GIN', 324, 224],
        [90, 'code'=>'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624, 245],
        [91, 'code'=>'GY', 'GUYANA', 'Guyana', 'GUY', 328, 592],
        [92, 'code'=>'HT', 'HAITI', 'Haiti', 'HTI', 332, 509],
        [93, 'code'=>'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL, 0],
        [94, 'code'=>'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336, 39],
        [95, 'code'=>'HN', 'HONDURAS', 'Honduras', 'HND', 340, 504],
        [96, 'code'=>'HK', 'HONG KONG', 'Hong Kong', 'HKG', 344, 852],
        [97, 'code'=>'HU', 'HUNGARY', 'Hungary', 'HUN', 348, 36],
        [98, 'code'=>'IS', 'ICELAND', 'Iceland', 'ISL', 352, 354],
        [99, 'code'=>'IN', 'INDIA', 'India', 'IND', 356, 91],
        [100, 'code'=>'ID', 'INDONESIA', 'Indonesia', 'IDN', 360, 62],
        [101, 'code'=>'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364, 98],
        [102, 'code'=>'IQ', 'IRAQ', 'Iraq', 'IRQ', 368, 964],
        [103, 'code'=>'IE', 'IRELAND', 'Ireland', 'IRL', 372, 353],
        [104, 'code'=>'IL', 'ISRAEL', 'Israel', 'ISR', 376, 972],
        [105, 'code'=>'IT', 'ITALY', 'Italy', 'ITA', 380, 39],
        [106, 'code'=>'JM', 'JAMAICA', 'Jamaica', 'JAM', 388, 1876],
        [107, 'code'=>'JP', 'JAPAN', 'Japan', 'JPN', 392, 81],
        [108, 'code'=>'JO', 'JORDAN', 'Jordan', 'JOR', 400, 962],
        [109, 'code'=>'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398, 7],
        [110, 'code'=>'KE', 'KENYA', 'Kenya', 'KEN', 404, 254],
        [111, 'code'=>'KI', 'KIRIBATI', 'Kiribati', 'KIR', 296, 686],
        [112, 'code'=>'KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of', 'PRK', 408, 850],
        [113, 'code'=>'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410, 82],
        [114, 'code'=>'KW', 'KUWAIT', 'Kuwait', 'KWT', 414, 965],
        [115, 'code'=>'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417, 996],
        [116, 'code'=>'LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic', 'LAO', 418, 856],
        [117, 'code'=>'LV', 'LATVIA', 'Latvia', 'LVA', 428, 371],
        [118, 'code'=>'LB', 'LEBANON', 'Lebanon', 'LBN', 422, 961],
        [119, 'code'=>'LS', 'LESOTHO', 'Lesotho', 'LSO', 426, 266],
        [120, 'code'=>'LR', 'LIBERIA', 'Liberia', 'LBR', 430, 231],
        [121, 'code'=>'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434, 218],
        [122, 'code'=>'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438, 423],
        [123, 'code'=>'LT', 'LITHUANIA', 'Lithuania', 'LTU', 440, 370],
        [124, 'code'=>'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442, 352],
        [125, 'code'=>'MO', 'MACAO', 'Macao', 'MAC', 446, 853],
        [126, 'code'=>'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807, 389],
        [127, 'code'=>'MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450, 261],
        [128, 'code'=>'MW', 'MALAWI', 'Malawi', 'MWI', 454, 265],
        [129, 'code'=>'MY', 'MALAYSIA', 'Malaysia', 'MYS', 458, 60],
        [130, 'code'=>'MV', 'MALDIVES', 'Maldives', 'MDV', 462, 960],
        [131, 'code'=>'ML', 'MALI', 'Mali', 'MLI', 466, 223],
        [132, 'code'=>'MT', 'MALTA', 'Malta', 'MLT', 470, 356],
        [133, 'code'=>'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584, 692],
        [134, 'code'=>'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474, 596],
        [135, 'code'=>'MR', 'MAURITANIA', 'Mauritania', 'MRT', 478, 222],
        [136, 'code'=>'MU', 'MAURITIUS', 'Mauritius', 'MUS', 480, 230],
        [137, 'code'=>'YT', 'MAYOTTE', 'Mayotte', NULL, NULL, 269],
        [138, 'code'=>'MX', 'MEXICO', 'Mexico', 'MEX', 484, 52],
        [139, 'code'=>'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583, 691],
        [140, 'code'=>'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498, 373],
        [141, 'code'=>'MC', 'MONACO', 'Monaco', 'MCO', 492, 377],
        [142, 'code'=>'MN', 'MONGOLIA', 'Mongolia', 'MNG', 496, 976],
        [143, 'code'=>'MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500, 1664],
        [144, 'code'=>'MA', 'MOROCCO', 'Morocco', 'MAR', 504, 212],
        [145, 'code'=>'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508, 258],
        [146, 'code'=>'MM', 'MYANMAR', 'Myanmar', 'MMR', 104, 95],
        [147, 'code'=>'NA', 'NAMIBIA', 'Namibia', 'NAM', 516, 264],
        [148, 'code'=>'NR', 'NAURU', 'Nauru', 'NRU', 520, 674],
        [149, 'code'=>'NP', 'NEPAL', 'Nepal', 'NPL', 524, 977],
        [150, 'code'=>'NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528, 31],
        [151, 'code'=>'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530, 599],
        [152, 'code'=>'NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540, 687],
        [153, 'code'=>'NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554, 64],
        [154, 'code'=>'NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558, 505],
        [155, 'code'=>'NE', 'NIGER', 'Niger', 'NER', 562, 227],
        [156, 'code'=>'NG', 'NIGERIA', 'Nigeria', 'NGA', 566, 234],
        [157, 'code'=>'NU', 'NIUE', 'Niue', 'NIU', 570, 683],
        [158, 'code'=>'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574, 672],
        [159, 'code'=>'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580, 1670],
        [160, 'code'=>'NO', 'NORWAY', 'Norway', 'NOR', 578, 47],
        [161, 'code'=>'OM', 'OMAN', 'Oman', 'OMN', 512, 968],
        [162, 'code'=>'PK', 'PAKISTAN', 'Pakistan', 'PAK', 586, 92],
        [163, 'code'=>'PW', 'PALAU', 'Palau', 'PLW', 585, 680],
        [164, 'code'=>'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL, 970],
        [165, 'code'=>'PA', 'PANAMA', 'Panama', 'PAN', 591, 507],
        [166, 'code'=>'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598, 675],
        [167, 'code'=>'PY', 'PARAGUAY', 'Paraguay', 'PRY', 600, 595],
        [168, 'code'=>'PE', 'PERU', 'Peru', 'PER', 604, 51],
        [169, 'code'=>'PH', 'PHILIPPINES', 'Philippines', 'PHL', 608, 63],
        [170, 'code'=>'PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612, 0],
        [171, 'code'=>'PL', 'POLAND', 'Poland', 'POL', 616, 48],
        [172, 'code'=>'PT', 'PORTUGAL', 'Portugal', 'PRT', 620, 351],
        [173, 'code'=>'PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630, 1787],
        [174, 'code'=>'QA', 'QATAR', 'Qatar', 'QAT', 634, 974],
        [175, 'code'=>'RE', 'REUNION', 'Reunion', 'REU', 638, 262],
        [176, 'code'=>'RO', 'ROMANIA', 'Romania', 'ROM', 642, 40],
        [177, 'code'=>'RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643, 70],
        [178, 'code'=>'RW', 'RWANDA', 'Rwanda', 'RWA', 646, 250],
        [179, 'code'=>'SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654, 290],
        [180, 'code'=>'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659, 1869],
        [181, 'code'=>'LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662, 1758],
        [182, 'code'=>'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666, 508],
        [183, 'code'=>'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670, 1784],
        [184, 'code'=>'WS', 'SAMOA', 'Samoa', 'WSM', 882, 684],
        [185, 'code'=>'SM', 'SAN MARINO', 'San Marino', 'SMR', 674, 378],
        [186, 'code'=>'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678, 239],
        [187, 'code'=>'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682, 966],
        [188, 'code'=>'SN', 'SENEGAL', 'Senegal', 'SEN', 686, 221],
        [189, 'code'=>'CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL, 381],
        [190, 'code'=>'SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690, 248],
        [191, 'code'=>'SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694, 232],
        [192, 'code'=>'SG', 'SINGAPORE', 'Singapore', 'SGP', 702, 65],
        [193, 'code'=>'SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703, 421],
        [194, 'code'=>'SI', 'SLOVENIA', 'Slovenia', 'SVN', 705, 386],
        [195, 'code'=>'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90, 677],
        [196, 'code'=>'SO', 'SOMALIA', 'Somalia', 'SOM', 706, 252],
        [197, 'code'=>'ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710, 27],
        [198, 'code'=>'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL, 0],
        [199, 'code'=>'ES', 'SPAIN', 'Spain', 'ESP', 724, 34],
        [200, 'code'=>'LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144, 94],
        [201, 'code'=>'SD', 'SUDAN', 'Sudan', 'SDN', 736, 249],
        [202, 'code'=>'SR', 'SURINAME', 'Suriname', 'SUR', 740, 597],
        [203, 'code'=>'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744, 47],
        [204, 'code'=>'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748, 268],
        [205, 'code'=>'SE', 'SWEDEN', 'Sweden', 'SWE', 752, 46],
        [206, 'code'=>'CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756, 41],
        [207, 'code'=>'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760, 963],
        [208, 'code'=>'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158, 886],
        [209, 'code'=>'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762, 992],
        [210, 'code'=>'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834, 255],
        [211, 'code'=>'TH', 'THAILAND', 'Thailand', 'THA', 764, 66],
        [212, 'code'=>'TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL, 670],
        [213, 'code'=>'TG', 'TOGO', 'Togo', 'TGO', 768, 228],
        [214, 'code'=>'TK', 'TOKELAU', 'Tokelau', 'TKL', 772, 690],
        [215, 'code'=>'TO', 'TONGA', 'Tonga', 'TON', 776, 676],
        [216, 'code'=>'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780, 1868],
        [217, 'code'=>'TN', 'TUNISIA', 'Tunisia', 'TUN', 788, 216],
        [218, 'code'=>'TR', 'TURKEY', 'Turkey', 'TUR', 792, 90],
        [219, 'code'=>'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795, 7370],
        [220, 'code'=>'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796, 1649],
        [221, 'code'=>'TV', 'TUVALU', 'Tuvalu', 'TUV', 798, 688],
        [222, 'code'=>'UG', 'UGANDA', 'Uganda', 'UGA', 800, 256],
        [223, 'code'=>'UA', 'UKRAINE', 'Ukraine', 'UKR', 804, 380],
        [224, 'code'=>'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784, 971],
        [225, 'code'=>'GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826, 44],
        [226, 'code'=>'US', 'UNITED STATES', 'United States', 'USA', 840, 1],
        [227, 'code'=>'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL, 1],
        [228, 'code'=>'UY', 'URUGUAY', 'Uruguay', 'URY', 858, 598],
        [229, 'code'=>'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860, 998],
        [230, 'code'=>'VU', 'VANUATU', 'Vanuatu', 'VUT', 548, 678],
        [231, 'code'=>'VE', 'VENEZUELA', 'Venezuela', 'VEN', 862, 58],
        [232, 'code'=>'VN', 'VIET NAM', 'Viet Nam', 'VNM', 704, 84],
        [233, 'code'=>'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92, 1284],
        [234, 'code'=>'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850, 1340],
        [235, 'code'=>'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876, 681],
        [236, 'code'=>'EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732, 212],
        [237, 'code'=>'YE', 'YEMEN', 'Yemen', 'YEM', 887, 967],
        [238, 'code'=>'ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894, 260],
        [239, 'code'=>'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716, 263],
    ];
    
    public function cs()
    {
        
        $cc = \App\Country::all();
        $list = collect($this->countries);
        
        foreach( $cc as $c )
        {
            
            $a = $list->where('code', $c->code)->first();
            
            $code = $a ? $a[5] : '';
            
            $txt = "['id'=> ".$c->id.", 'code'=> '".$c->code."', 'name'=> '".$c->name."', 'phone_code'=> '+".$code."'],";
            
            if($a)
            {
                // return $a;
                
                $myfile = file_put_contents('c.php', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
                
            }
            
        }
        
    }
    
}