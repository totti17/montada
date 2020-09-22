$(document).ready(function() {
    $(".agreesPayment button").click(function(){
        $(".agreesPayment").fadeOut(200);
    });
    //
    $(function() {
        $('#froala-editor').froalaEditor({
            height: 300,
            direction: 'rtl'
        });
    });      
    $(function() {
        $('#froala-editor1').froalaEditor({
            height: 300,
            direction: 'rtl'
        });
    });   
    $(function() {
        $('#froala-editor2').froalaEditor({
            height: 300,
            direction: 'rtl'
        });
    });  
    $(function() {
        $('#froala-editor3').froalaEditor({
            height: 300,
            direction: 'rtl'
        });
    }); 
});

$(function () {
/*Start Time Ago*/

//Check if date is today
function isToday(momentDate) {
  var yesterday = moment().clone().startOf('day');
  return momentDate.isSame(yesterday , 'd');
}

//Check if date is yesterday
function isYesterday(momentDate) {
  var yesterday = moment().clone().subtract(1, 'days').startOf('day');
  return momentDate.isSame(yesterday , 'd');
}


/*Time ago function*/
function timeAgo (timestamp, DWMY_timeAgo = true) { // DWMY_timeAgo = [Days,Weeks,Months,Years] ago
  var momentDate  = moment.unix(timestamp), // Getting date and time with unix timestamp
      dateTime    = {
        seconds        : moment().diff(momentDate, 'seconds'),
        minutes        : moment().diff(momentDate, 'minutes'),
        hours          : moment().diff(momentDate, 'hours'),
        days           : moment().diff(momentDate, 'days'),
        weeks          : moment().diff(momentDate, 'weeks'),
        months         : moment().diff(momentDate, 'months'),
        years          : moment().diff(momentDate, 'years'),
        today          : isToday(momentDate),
        yesterday      : isYesterday(momentDate),
        dayName        : momentDate.format('dddd'),
        fullDateTime   : momentDate.format('LLLL'),
        date           : momentDate.format('LL'),
        time           : momentDate.format('LT'),
        calendar       : momentDate.calendar()
      },
      datetime = dateTime.date + ' في ' + dateTime.time;
  outputTime = '';


  if (dateTime.seconds > 0) {
    outputTime = ' ثانية';
  }
  if (dateTime.seconds > 1) {
    outputTime = dateTime.seconds + ' ثواني مضت';
  }

  if (dateTime.minutes == 1) {
    outputTime = 'منذ دقيقة مضت';
  }
  if (dateTime.minutes > 1) {
    outputTime = dateTime.minutes + ' دقائق مضت ';
  }

  if (dateTime.hours == 1) {
    outputTime = ' ساعة مضت';
  }
  if (dateTime.hours > 1) {
    outputTime = dateTime.hours + ' ساعات مضت';
  }

  if (dateTime.days == 1) {
    if (DWMY_timeAgo) {
      outputTime = ' يوم';
    } else {
      outputTime = datetime;
    }
  }
  if (dateTime.days > 1) {
    if (DWMY_timeAgo) {
      outputTime = dateTime.days + ' أيام مضت ';
    } else {
      outputTime = datetime;
    }
  }

  //weeks
  if (dateTime.weeks == 1) {
    if (DWMY_timeAgo) {
      outputTime = dateTime.weeks + ' أسبوع';
    } else {
      outputTime = datetime;
    }
  }
  if (dateTime.weeks > 1) {
    if (DWMY_timeAgo) {
      outputTime = dateTime.weeks + ' أسابيع';
    } else {
      outputTime = datetime;
    }
  }

  if (dateTime.months == 1) {
    if (DWMY_timeAgo) {
      outputTime = ' شهر مضى ';
    } else {
      outputTime = datetime;
    }
  }
  if (dateTime.months > 1) {
    if (DWMY_timeAgo) {
      outputTime = dateTime.months + ' شهور مضت';
    } else {
      outputTime = datetime;
    }
  }

  if (dateTime.years == 1) {
    if (DWMY_timeAgo) {
      outputTime = ' سنة مضت ';
    } else {
      outputTime = datetime;
    }
  }
  if (dateTime.years > 1) {
    if (DWMY_timeAgo) {
      outputTime = dateTime.yeras + ' سنين مضت ';
    } else {
      outputTime = datetime;
    }
  }

  
 
  return outputTime;
}


/*End Time Ago*/

  //Run realtime time ago function 
  setInterval(function () {
    $('.timeAgos').find('.datetime').each(function () {
      var $this = $(this);

      $this.html(timeAgo($this.attr('id'), true));
      /*
      [true] parameter to Show days,weaks,months,years ago
      example: 5 days ago
      */
    });
  }, 1000);

/*Time ago function object*/
     setInterval(function () {
    $('.timeAgos').find('.datetime2').each(function () {
      var $this = $(this);

      $this.html(timeAgo($this.attr('id'), true));
      /*
      [true] parameter to Show days,weaks,months,years ago
      example: 5 days ago
      */
    });
  }, 1000); 
      
      $('.datetime,.datetime2').attr('id', unixTimestamp);
        timeAgoObject(unixTimestamp);
      
});
function createTitle() {
    var row;
    for (i = 1; i <= document.getElementById("titleCount").value; i++) {
        rowNum = i;
        row = row +'<label>العنوان رقم '+ rowNum +'</label><input class="form-control" type="text" name="title['+ rowNum +'][name]" /> ';  
    }
    jQuery('#showTitle').html(row);
}