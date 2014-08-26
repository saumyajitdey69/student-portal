function add_row(course_id,course_name) {
  var courseid = '<td>'+ course_id + '</td>';
  var coursename = '<td>'+ course_name+'</td>';
  var action_btn = '<td>'+'<button type="button" class="btn btn-danger btn-xs btn-remove"><span class="glyphicon glyphicon-remove"></span></button>'+'</td>';
  var content = courseid + coursename + action_btn;
  var row = '<tr>'+content+'</tr>';
  $('.table-editable').find('tbody').append(row);
}
function remove_course () {
  hide_error();
  el = $(this);
  el.closest('tr').remove();
}

$(document).on( "click", ".btn-remove", remove_course );
$(document).on( "submit", ".new-registration", update_courses );
$(document).on( "click", ".btn-courseid", add_course );

function update_courses(){   
  hide_error(); 
  var el = $('.btn-submit');
  var tid, tdate,totamt;
  if(check_paid == false)
  {
   el.button('reset');
   return false;
 }
 tid = $('#inputTransactionId').val();
 tdate = $('#inputTDate').val();
 totamt = $('#inputTotalAmt').val();
 var courses_list=[];
 $('.table-editable tbody tr').each(function(index) {
   var item={};
   item['course_id'] = $(this).find(":eq(0)").html();
   item['course_name'] = $(this).find(":eq(1)").html();
   courses_list.push(item);
 });
  // console.log(courses_list);

  el.button('loading');
  courses_list = JSON.stringify(courses_list)
  // console.log(tid + "," + tdate+"," + totamt +", " + courses_list);
      // var courseid[] = 
      $.ajax({
        type: "POST",
        url: "/academic_audit/makeup/register", 
        data: {'transactionId':tid, 'totalAmtPaid':totamt, 'tDate':tdate, "courses_list":courses_list},
        beforeSend:function(){

        },
        success: 
        function(data){
          data = JSON.parse(data);
          el.button('reset');
          if(data.code == "1")
          {
            init();
            add_register_table_row(tid, totamt, tdate);
            clear();
          }
          else
          {
            show_error(data.message, true);
          }
        }
      });
      return true;
    }

    function add_register_table_row (tid, totamt, tdate) {
      content = "";
      content += "<tr>";
      content += "<td>";
      content += tid;
      content += "</td>";
      content += "<td>";
      content += totamt;
      content += "</td>";
      content += "<td>";
      content += tdate;
      content += "</td>";
      content += "<td>";
      content += "<ul>";
      $('.table-editable tbody tr').each(function(index) {
        content += "<li>" + $(this).find(":eq(0)").html() + "(" + $(this).find(":eq(1)").html() + ") </li>";
      });
      content += "</ul>";
      content += "</td>";
      content += "</tr>";
      $('.table-status tbody').append(content);
    }

    function add_course(){  
      var el = $(this);
      el.button('loading');
      hide_error()
      var courseid,flag = true;
      courseid = $('#inputCourseid').val().toUpperCase();
      if(check_paid == false)
      {
       el.button('reset');
       return false;
     }
     var courses_list=[];
     $('.table-editable tbody tr').each(function(){
      if($.trim($(this).find(':eq(0)').html()) == $.trim(courseid))
      {
        show_error("Course already exist in the list", true);
        flag = false;
        el.button('reset');
        return;
      }
    });
     if(flag == false)
      return;
    $.ajax({
      type: "POST",
      url: "/academic_audit/makeup/get_course", 
      data: {'courseid':courseid},
      beforeSend:function(){
      },
      success: 
      function(data){
        data = JSON.parse(data);
        el.button('reset');
        if(data.code == "1")
        {
          add_row(data.course_id, data.course_name);
          $('#inputCourseid').val("");
          if(check_paid == false)
          {
            return false;
          }
        }
        else
        {
         var course_name = window.prompt("Course Name is not available, please enter the full name of the course (do not use abbrevations):")
          if(course_name.length > 5)
          {
            $.ajax({
              url: '/academic_audit/makeup/add_course',
              type: 'post',
              data: {'course_id':courseid, 'course_name':course_name},
              success: function (data) {
                data = JSON.parse(data);
                if(data.code == "1")
                {
                  add_row(courseid, course_name);
                  $('#inputCourseid').val("");
                  if(check_paid == false)
                  {
                    return false;
                  }
                }
                else
                {
                  show_error(data.message, true);
                }
              }
            });
          }
        }
      }
    });

return true;
}

function show_error(message, type)
{

  $('.alert-makeup').html('');
  if(type==false)
  {
    $('.alert-makeup').removeClass('alert-danger').addClass('alert-success');
  }
  else
  {
    $('.alert-makeup').removeClass('alert-success').addClass('alert-danger');
  }
  $('.alert-makeup').append(message);
  $('.alert-makeup').removeClass('hidden');
}

function hide_error()
{
  $('.alert-makeup').addClass('hidden');
}

function  check_paid(){
  var amt = parseInt($('inputTotalAmt').val());
  if(amt%600 != 0){
    show_error("Ammount should be multiple of 600");
    return false;
  }
  var course_count = 0;
  $('.table-editable tbody tr').each(function(){
    course_count++;
  });
  if(amt/600 != course_count)
  {
    show_error("Amount paid and courses registered mismatch. You should register for " + amt/600 + " but you are trying to register " + course_count + " courses");
    return false;
  }
  return true;
}

function init () {
  if(isEmpty($('.div-status')))
  {
    content = '<div class="row div-status">' +
    '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">' +
    '<div class="panel panel-default">' +
    '<div class="panel-heading">' +
    '<h3 class="panel-title">Registration Status</h3>' +
    '</div>' +
    '<div class="panel-body">' +
    '<table class="table table-hover table-condensed table-striped table-bordered table-status">' +
    '<thead>' +
    '<tr>' +
    '<th>Transaction Id</th>' +
    '<th>Total Amt. Paid</th>' +
    '<th>Transaction Date</th>' +
    '<th>Registerted Courses</th>' +
    '</tr>' +
    '</thead>' +
    '<tbody>' +
    '</tbody>' +
    '</table>' +
    '</div>' +
    '</div>' +
    '</div>' +
    '</div>';
    $('#status-panel').html(content);
    return true;
  }
  else
  {
    return false;
  }
}

// Speed up calls to hasOwnProperty
var hasOwnProperty = Object.prototype.hasOwnProperty;

function isEmpty(obj) {

    // null and undefined are "empty"
    if (obj == null) return true;

    // Assume if it has a length property with a non-zero value
    // that that property is correct.
    if (obj.length > 0)    return false;
    if (obj.length === 0)  return true;

    // Otherwise, does it have any properties of its own?
    // Note that this doesn't handle
    // toString and valueOf enumeration bugs in IE < 9
    for (var key in obj) {
      if (hasOwnProperty.call(obj, key)) return false;
    }

    return true;
  }

  function clear ( ) {
    $('.table-editable tbody').html("");
    $('input').val("");
  }