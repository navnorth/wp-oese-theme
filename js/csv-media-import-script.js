jQuery(document).ready(function ($) {
   $('#csv_media_upload').click(function() {
   $(".results_table").hide();
   $(".page_count").text();
   $('#page_result > tbody > tr > td').parent('tr').empty();
    if( document.getElementById("fileToUpload").files.length == 0 ){
      $(".csv-media-import .error_message").text("Please select a csv file to upload")
    }
    else{
        $(".ajaxload").show();
        $(".error_message").text("");
        var file_data = $('#fileToUpload').prop('files')[0];   
        var form_data = new FormData();                  
        form_data.append('file', file_data);
        form_data.append('action', 'csvMediaImport');   
        $.ajax({
                  type : "POST", 
                  url: ajaxurl,
                  data:form_data,
                  contentType: false,
                  enctype: 'multipart/form-data',
                  processData: false,
                  success:function(data) {
                    console.log(data);
                    $(".ajaxload").hide();
                    
                    // if(data){  
                    //   $(".results_table").show();
                    //   $(".page_count").text(data.length+" pages has been created");
                    //   data.forEach(function(value) {
                    //     $("#page_result").append("<tr><td>"+value.page_title+"</td><td><a href="+value.edit_link+">Edit</a></td></tr>")
                    //   });
                    // }  
                  },
                  error: function(errorThrown){
                      console.log(errorThrown);
                  }
              });
      }
    
    });

});


function convertArrayOfObjectsToCSV(args) {
        var result, ctr, keys, columnDelimiter, lineDelimiter, data;

        data = args.data || null;
        if (data == null || !data.length) {
            return null;
        }

        columnDelimiter = args.columnDelimiter || ',';
        lineDelimiter = args.lineDelimiter || '\n';

        keys = Object.keys(data[0]);

        result = '';
        result += keys.join(columnDelimiter);
        result += lineDelimiter;

        data.forEach(function(item) {
            ctr = 0;
            keys.forEach(function(key) {
                if (ctr > 0) result += columnDelimiter;

                result += item[key];
                ctr++;
            });
            result += lineDelimiter;
        });

        return result;
    }

  function downloadCSV(args) {
        var data, filename, link;

        var csv = convertArrayOfObjectsToCSV({
            data: stockData
        });
        if (csv == null) return;

        filename = args.filename || 'export.csv';

        if (!csv.match(/^data:text\/csv/i)) {
            csv = 'data:text/csv;charset=utf-8,' + csv;
        }
        data = encodeURI(csv);

        link = document.createElement('a');
        link.setAttribute('href', data);
        link.setAttribute('download', filename);
        link.click();
    }   