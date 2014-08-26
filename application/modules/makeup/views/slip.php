<!DOCTYPE html>
<html style="
    background: #FFFFFF url(/nit/academic_audit/images/body-bkg.png) repeat;
">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registration Slip</title>
<meta name="author" content="WSDC" />
<link rel="shortcut icon" href="/nit/academic_audit/images/nitw.ico" />

<link href="/nit/academic_audit/style.css" rel="stylesheet" type="text/css" media="screen" />
<link type="text/css" rel="stylesheet" href="/nit/academic_audit/css/login.css" />

<script type="text/javascript" src="/nit/academic_audit/js/jquery-1.7.1.min.js"></script>
<link type="text/css" rel="stylesheet" href="/nit/academic_audit/feedback/css/login.css" />
<link type="text/css" rel="stylesheet" href="/nit/academic_audit/feedback/css/feedback.css" media="screen"/>
<style type="text/css" media="print" />
    #left-content, #printcmd{

        display: none;
    }

</style>
<style type="text/css">
  html, body, div, h1, h2, h3, h4, h5, h6, p, dl,
  dt, dd, ol, ul, li{
  font:1em "Lucida Sans Unicode", "Lucida Grande", sans-serif;
  line-height:1.5em;
  color:#444;
  margin: 0;
  padding: 0;
  border: 0;
  }
  .mycomment{
  font:1em "Lucida Sans Unicode", "Lucida Grande", sans-serif;
  font-size:12px;
  }
    body{
    font-size:12px;
    background: #FFFFFF url(/nit/academic_audit/feedback/images/bg.jpg) repeat;
  }
  .main {
    margin: 0 auto;
    width: 650px;
    padding-top: 23px;
    padding-bottom: 0px;
  }
  .main h1:first-child {
    margin: 0 0 .92em;
  }
  </style>
  <style type="text/css">
  .main {
    width: auto;
    max-width: 1000px;
    min-width: 780px;
  }
  body{
  margin:0px;
  }
    .panes div {
    display:none;
    padding:15px 10px;
    border:1px solid #999;
    border-top:0;
    height:auto;
    font-size:14px;
    background-color:#fff;
}
</style>
<style>
.table{
margin:0px;
}
table{
text-align:left;
}
table td {
    width: 1px;
        white-space: nowrap;
}
#login label{
float:right;
}
</style>
</head>

<body>
<div class="header-bar" style="padding-left: 5px; background:white;">
  <div class="header content clearfix" style="color:white;">
  <img src="/nit/academic_audit/images/banner_print_even.jpg" style="
    width: 600px;
    height: 82px;
">
  </div>

</div>

<div id="right-content" class="right-content" >
<form name="login" id="login" style="width:85%; min-width:500px; border-radius:10px; margin-top:5px;" method="POST" action="courseoffers.php">

    <div>
        <table>
        <tr>

        <td style="width:80px; text-align:left;"><label><strong> Roll No</strong></label></td>
        <td style="width:20px; text-align:center;"> : </td>
        <td style="width:100px; text-align:left;"><?php echo $reg_roll; ?><input type="hidden" name="roll" value="<?php echo $reg_roll; ?>" required/></td>

        <td style="width:60px; text-align:left;"><label><strong>Name</strong></label></td>
        <td style="width:20px; text-align:center;"> : </td>
        <td style="width:400px; text-align:left;"><?php echo $reg_name; ?><input type="hidden" name="name" value="<?php echo $reg_name; ?>" required/></td>

        </tr>

        </table>
    </div>

    <div>
        <table>
        <tr>

        <td style="width:80px; text-align:left;"><label><strong>Branch</strong></label></td>
        <td style="width:20px; text-align:center;"> : </td>
        <td style="width:120px; text-align:left;"><?php echo strtoupper($reg_branch); ?></td>

        <td style="width:60px; text-align:left;"><label><strong>Transaction Id</strong></label></td>
        <td style="width:20px; text-align:center;"> : </td>
        <td style="width:400px; text-align:left;">

<?php foreach ($transaction_ids as $key => $tid) {
    echo $tid.'<br>';
} ?>

        </tr>
        </table>
    </div>

    <div>
    
        <table>
        <tr>
        <td style="width:80px; text-align:left;"><label><strong>Course</strong></label></td>
        <td style="width:20px; text-align:center;"> : </td>
        <td style="width:400px; text-align:left;"><span id="class"><?php echo $reg_course; ?></span></td>
        <script>
            (function () {
                var classdesc;
                switch ("<?php echo $reg_course; ?>") {
                    case 'Physics Cycle':
                        classdesc = 'PHYSICS CYCLE';
                        break;
                    case 'Chemistry Cycle':
                        classdesc = 'CHEMISTRY CYCLE';
                        break;
                    case 'BTech':
                        classdesc = 'BACHELOR OF TECHNOLOGY';
                        break;
                    case 'Mtech CTM':
                        classdesc = 'MASTER OF TECHNOLOGY - CONSTRUCTION TECHNOLOGY AND MGMT.';
                        break;
                    case 'Mtech ES':
                        classdesc = 'MASTER OF TECHNOLOGY - ENGINEERING STRUCTURES';
                        break;
                    case 'Mtech EE':
                        classdesc = 'MASTER OF TECHNOLOGY - ENVIRONMENTAL ENGINEERING';
                        break;
                    case 'Mtech GTE':
                        classdesc = 'MASTER OF TECHNOLOGY - GEOTECHNICAL ENGINEERING';
                        break;
                    case 'Mtech RSGIS':
                        classdesc = 'MASTER OF TECHNOLOGY - REMOTE SENSING AND GIS';
                        break;
                    case 'Mtech TrE':
                        classdesc = 'MASTER OF TECHNOLOGY - TRANSPORTATION ENGINEERING';
                        break;
                    case 'Mtech WRE':
                        classdesc = 'MASTER OF TECHNOLOGY - WATER RESOURCES ENGINEERING';
                        break;
                    case 'Mtech PED':
                        classdesc = 'MASTER OF TECHNOLOGY - POWER ELECTRONICS AND DRIVES';
                        break;
                    case 'Mtech PSE':
                        classdesc = 'MASTER OF TECHNOLOGY - POWER SYSTEMS ENGINEERING';
                        break;
                    case 'Mtech ThE':
                        classdesc = 'MASTER OF TECHNOLOGY - THERMAL ENGINEERING';
                        break;
                    case 'Mtech MfE':
                        classdesc = 'MASTER OF TECHNOLOGY - MANUFACTURING ENGINEERING';
                        break;
                    case 'Mtech CIM':
                        classdesc = 'MASTER OF TECHNOLOGY - COMPUTER INTEGRATED MANUFACTURING';
                        break;
                    case 'Mtech PDD':
                        classdesc = 'MASTER OF TECHNOLOGY - PRODUCT DESIGN AND DEVELOPMENT';
                        break;
                    case 'Mtech AE':
                        classdesc = 'MASTER OF TECHNOLOGY - AUTOMOBILE ENGINEERING';
                        break;
                    case 'Mtech MSED':
                        classdesc = 'MASTER OF TECHNOLOGY - MATERIALS AND SYSTEM ENGINEERING DESIGN';
                        break;
                    case 'Mtech EI':
                        classdesc = 'MASTER OF TECHNOLOGY - ELECTRONIC INSTRUMENTATION';
                        break;
                    case 'Mtech VLSI':
                        classdesc = 'MASTER OF TECHNOLOGY - VLSI SYSTEM DESIGN';
                        break;
                    case 'Mtech ACS':
                        classdesc = 'MASTER OF TECHNOLOGY - ADVANCED COMMUNICATION SYSTEMS';
                        break;
                    case 'Mtech MT':
                        classdesc = 'MASTER OF TECHNOLOGY - MATERIALS  TECHNOLOGY';
                        break;
                    case 'Mtech IM':
                        classdesc = 'MASTER OF TECHNOLOGY - INDUSTRIAL METALLURGY';
                        break;
                    case 'Mtech CAPED':
                        classdesc = 'MASTER OF TECHNOLOGY - COMPUTER AIDED PROCESS AND EQUIPMENT DESIGN';
                        break;
                    case 'Mtech CSE':
                        classdesc = 'MASTER OF TECHNOLOGY - COMPUTER SCIENCE & ENGG.';
                        break;
                    case 'Mtech IS':
                        classdesc = 'MASTER OF TECHNOLOGY - INFORMATION SECURITY';
                        break;
                    case 'MBA':
                        classdesc = 'MASTER OF BUSINESS MANAGEMENT';
                        break;
                    case 'MCA':
                        classdesc = 'MASTER OF COMPUTER APPLICATIONS';
                        break;
                    case 'MSc AM':
                        classdesc = 'M.SC. APPLIED MATHEMATICS';
                        break;
                    case 'MSc MSC':
                        classdesc = 'M.SC. MATHEMATICS AND SCIENTIFIC COMPUTING';
                        break;
                    case 'MSc MMCA':
                        classdesc = 'M.SC.(CHEMISTRY) MMCA';
                        break;
                    case 'MSc DDPP':
                        classdesc = 'M.SC.(CHEMISTRY) DDPP';
                        break;
                    case 'MSc T EP':
                        classdesc = 'M.SC. (TECH) ENGINEERING PHYSICS';
                        break;
                    case 'MSc T ELECT':
                        classdesc = 'M.SC(TECH) ELECTRONICS';
                        break;
                    case 'MSc T PHOT':
                        classdesc = 'M.SC (TECH) PHOTONICS';
                        break;
                    case 'MSc T INSTR':
                        classdesc = 'M.SC. (TECH) INSTRUMENTATION';
                        break;
                    default:
                        classdesc = '<?php echo $reg_course; ?>';
                        break;
                }
                document.getElementById('class').innerHTML = classdesc;
            })();
        </script>
       
        </tr>

        </table>
    </div>

    <div>
    <table id = "regular_course_table" border="1">
            <th>S.No.</th>
            <th>Course Code</th>
            <th>Course Title</th>
            <th>Semester</th>
            <th>Year</th>
            <?php

            $reg_credits_makeup=0;
            $type  = array(
                '0' =>"Makeup" ,
                '1' =>"Makeup" ,
                "sb" =>"Study"
                );

                    //printing out all course detail
            foreach ($details as $key => $detail){
                echo "<tr>";
                echo "<td>";
                echo ($key+1);
                echo "</td>";
                echo "<td>";
                echo $detail['course_id'];
                echo "</td>";
                echo "<td>";
                echo strtoupper($detail['course_name']);
                echo "</td>";
                echo "<td>";
                echo $detail['sem'];
                echo "</td>";
                echo "<td>";
                echo $detail['year'];
                echo "</td>";
                echo "</tr>";    
       

            }

            ?>
        </table>
    </div>
    <!-- <div>
        <table class="hidden">
        <tr>
        <td style="width:250px; text-align:left;"><strong>Total Credits(Make up)</strong></td>
        <td style="width:20px; text-align:center;"> : </td>
        <td style="width:20px; text-align:left;"><?php echo$reg_credits_makeup; ?></td>
       
        </tr>
        </table>
    </div> -->

    <div>
        <table>
        <tr>
        <td style="width:150px; text-align:left;"><strong>Date</strong></td>
        <td style="width:20px; text-align:left;"> : </td>
        <td style="width:530px; text-align:left;"><?php echo date("d-m-y"); ?></td>
        </tr>
        </table>
    </div>

    <div>
        <table>
        <tr>
        <td style="width:150px; text-align:left;"><strong>Remarks (If Any) </strong></td>
        <td style="width:500px;">&nbsp;</td>
        </tr>   </table>
    </div>

    <div>
        <table>
        <tr>
        <td>&nbsp; </td>
        <td style="width:50px;">&nbsp; </td>
        <td>&nbsp; </td>
        </tr>
        <tr>
        <td style="text-align:left;">Signature of the Student</td>
        <td style="width:50px;">&nbsp; </td>
        <td><label>Signature of Faculty Advisor</label></td>
        </tr>
        </table>
    </div>

    <div style="text-align:center;">No Student will be permitted to the examinations of this semester without the Registration Slip
    <div>
    <div id="printcmd">
        <center><button type="button" onclick="javascript: window.print();">Print</button> &nbsp;
    </div>

<!--    <p class="back" style="font-size:1px"></p>-->
    <p align="center"   ><a target="_blank" href="nitw/index.php/component/content/article/580"><img src="http://www.nitw.ac.in/nitw/images/logo_wsdc.png" width=70px ></a><br>&#169 2014, <a href="nitw/index.php/component/content/article/580" target="_blank">NITW Web and Software Development Cell</a></p>
</form>
<script>
    $(window).load(function() {
        window.print();
    });
</script>
</body>
</html>
