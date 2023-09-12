
$(document).ready(function() {
  
    
    $('#datatable').DataTable();
   
    //Buttons examples
    var table = $('#datatable-buttons').DataTable({
        lengthChange: true,
        buttons: ['excel', 'pdf', 'colvis']
        
    });
    table.buttons().container()
        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
        
    var tableView = $('#datatable-buttons-view').DataTable({
        lengthChange: true,
        buttons: []
    });

    tableView.buttons().container()
        .appendTo('#datatable-buttons-view_wrapper .col-md-6:eq(0)');
        
        
        
    //customer , sold  , leads
    var tableLead = $('#datatable-leads').DataTable({
        lengthChange: true,
        
        buttons: [
                {
                    extend: 'print',
                    exportOptions: {
                         columns: [ 0,1,2,3,4,5,6,7]
                    },
                    customize: function ( win ) {
                        $(win.document.body)
                            .css( 'font-size', '10pt' );
                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', 'inherit' );
                    } 
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [ 0,1,2,3,4,5,6,7] 
                        
                    }
                    
                }, 
                {
                    extend: 'excel',
                    exportOptions: {
                    columns: [ 0,1,2,3,4,5,6,7]
                }
                }
            ]
        
    });
    tableLead.buttons().container()
        .appendTo('#datatable-leads_wrapper .col-md-6:eq(0)');
        
        
    //0,1,2,3,4 columns
    var tableFour = $('#datatable-fourcols').DataTable({
        lengthChange: true,
        
        buttons: [
                {
                    extend: 'print',
                    exportOptions: {
                         columns: [ 0,1,2,3,4]
                    },
                    customize: function ( win ) {
                        $(win.document.body)
                            .css( 'font-size', '10pt' );
                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', 'inherit' );
                    } 
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [ 0,1,2,3,4]
                        
                    }
                    
                }, 
                {
                    extend: 'excel',
                    exportOptions: {
                    columns: [ 0,1,2,3,4]
                }
                }
            ]
        
    });
    tableFour.buttons().container()
        .appendTo('#datatable-fourcols_wrapper .col-md-6:eq(0)'); 
        
    //0,1,2,3,4,5 columns
    var tableFive = $('#datatable-fivecols').DataTable({
        lengthChange: true,
        
        buttons: [
              {
                    extend: 'print',
                    exportOptions: {
                         columns: [ 0,1,2,3,4,5]
                    },
                    customize: function ( win ) {
                        $(win.document.body)
                            .css( 'font-size', '10pt' );
                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', 'inherit' );
                    } 
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [ 0,1,2,3,4,5]
                        
                    }
                    
                }, 
                {
                    extend: 'excel',
                    exportOptions: {
                    columns: [ 0,1,2,3,4,5]
                }
                }
            ]
        
    });
    tableFive.buttons().container()
        .appendTo('#datatable-fivecols_wrapper .col-md-6:eq(0)'); 
        
    //0,1,2,3,4,5,6 columns
    var tableSix = $('#datatable-sixcols').DataTable({
        lengthChange: true,
        
        buttons: [
              {
                    extend: 'print',
                    exportOptions: {
                         columns: [ 0,1,2,3,4,5,6]
                    },
                    customize: function ( win ) {
                        $(win.document.body)
                            .css( 'font-size', '10pt' );
                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', 'inherit' );
                    } 
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [ 0,1,2,3,4,5,6]
                        
                    }
                    
                }, 
                {
                    extend: 'excel',
                    exportOptions: {
                    columns: [ 0,1,2,3,4,5,6]
                }
                }
            ]
        
    });
    tableSix.buttons().container()
        .appendTo('#datatable-sixcols_wrapper .col-md-6:eq(0)');     
        
        
        
        
        
} );