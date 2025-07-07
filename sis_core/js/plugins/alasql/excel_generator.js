// ===== Original EXAMPLE =====
// req : jquery.js 
// req : alasql.min.js 
// req : xlsx.core.min.js 
// 
// var sheet = [{sheetid:'One',header:true},{sheetid:'Two',header:false}];
// var data_sheet1 = [{a:1,b:10},{a:2,b:20}];
// var data_sheet2 = [{a:100,b:10},{a:200,b:20}];
// 
// var data = [data_sheet1, data_sheet2];
//  var res = alasql('SELECT INTO XLSX("restest344b.xlsx",?) FROM ?',
//      [opts,data]);
// }
// =============


// ====== How To Use ===========
//      let excel_1 = new ExellReport();
//      excel_1.addSheet('sheet_1');
//      excel_1.addSheet('sheet_2');
//      excel_1.addRow('sheet_1', {'col_1':'val 1', 'col_2':'val 2'});
//      excel_1.addRow('sheet_1', {'col_1':'val 1', 'col_2':'val 2'});
//      excel_1.addRow('sheet_1', {'col_1':'val 1', 'col_2':'val 2'});
//      excel_1.init();
// =============================

// $.getScript('../../../../assets/js/plugins/alasql/alasql.min.js', function(){});
// $.getScript('../../../../assets/js/plugins/alasql/xlsx.core.min.js', function(){});

class ExcelReport{
    constructor() {
            this.file_name='default';
            this.sheet=[];
            this.find_sheet={};
            this.data=[];
        }

        addSheet(sheet_name='sheet')
        {
            if( typeof this.find_sheet[sheet_name]!='undefined' ){
                console.error('sheet name "'+sheet_name+'" already exist');
                return false;
            }
            this.sheet.push({sheetid:sheet_name,
                headers:true,
                column: {style:{Font:{Bold:"1",Color: "#3C3741"}}},
                rows: {1:{style:{Font:{Color:"#FF0077"}}}},
                cells: {1:{1:{
                    style: {Font:{Color:"#00FFFF"}}
                }}}

            });
            this.data.push([]);
            this.find_sheet[sheet_name] = this.sheet.length-1;
        }

        addRow(sheet_name=0, row={col_1:'val 1', col_2:'val 2'})
        {
            if( this.sheet.length==0 ){
                console.error('addSheet first!');
                return false;
            }
            if(sheet_name==0){
                this.data[0].push(row);
            }else{
                if( typeof this.find_sheet[sheet_name]=='undefined' ){
                    this.data[0].push(row);
                }else{
                    this.data[this.find_sheet[sheet_name]].push(row);
                }
            }
        }

        init(file_name='')
        {  
            if(file_name==''){
                file_name = this.file_name;
            }
            
            var sheet = this.sheet;
            var data = this.data;
            $.each(data, function(key, val) {
                if( val.length==0 ){
                    data[key].push({'':''});
                }
            });
            alasql('SELECT INTO XLSX("'+file_name+'.xlsx",?) FROM ?',[sheet,data]);

        //clear all to default after init
        this.file_name='default';
        this.sheet=[];
        this.find_sheet={};
        this.data=[];
    }
}