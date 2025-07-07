

// type_storage : variable, table
// let myStorage = new MyLocalStorage();

class MyLocalStorage{
	constructor() {
		this.storageVariable = localStorage.getItem("variable")==null? {} : JSON.parse(localStorage.getItem("variable"));
		this.storageTable = localStorage.getItem("table")==null? {} : JSON.parse(localStorage.getItem("table"));
		var listId=[];
		$.each(this.storageVariable, function(key, val) {
			listId.push({id:key, type_storage:'variable'});
		});
		$.each(this.storageTable, function(key, val) {
			listId.push({id:key, type_storage:'table'});
		});
		this.listId = listId;
	}

	setLocalStorage(){
		localStorage.setItem("variable", JSON.stringify(this.storageVariable));
		localStorage.setItem("table", JSON.stringify(this.storageTable));	
	}

	getAllStorage(){
		var all = [];
		all.push(this.storageVariable);
		all.push(this.storageTable);
		return all;
	}

	getAllId(){
		return this.listId;
	}

	getStorage(id_storage){
		var result = '';
		var listId = this.listId;
		var cek_storage = [];
		if(listId.length>0){
			cek_storage = alasql("SELECT * FROM ? WHERE id = '"+id_storage+"'",[listId]);
		}

		if( cek_storage.length==0){
			console.error('Storage "'+id_storage+'" tidak ditemukan, silahkan definisikan terlebih dahulu');
		}

		if( cek_storage.length>0 && cek_storage[0].type_storage=='variable'){
			result = this.storageVariable[id_storage];
		}
		if( cek_storage.length>0 && cek_storage[0].type_storage=='table'){
			result = this.storageTable[id_storage];
		}
		return result;
	}

	setVariable(id_storage, content=''){
		var listId = this.listId;
		var cek_storage = [];
		if(listId.length>0){
			cek_storage = alasql("SELECT * FROM ? WHERE id = '"+id_storage+"'",[listId]);
		}

		if( cek_storage.length==0 || (cek_storage.length>0 && cek_storage[0].type_storage=='variable') ){
			this.storageVariable[id_storage]=content;

			this.listId.push({id:id_storage, type_storage:'variable'});
			this.setLocalStorage();
		}
		
	}
	//=================================================

	//============= For Table =========================
	setTable(id_storage){
		var listId = this.listId;
		var cek_storage = [];
		if(listId.length>0){
			cek_storage = alasql("SELECT * FROM ? WHERE id = '"+id_storage+"'",[listId]);
		}
		if( cek_storage.length==0){
			this.storageTable[id_storage]=[];
			this.listId.push({id:id_storage, type_storage:'table'});
			this.setLocalStorage();
		}else{
			console.error('Nama Storage "'+id_storage+'" sudah dipakai!');
		}
	}

	addRowTable(id_storage, data={}){
		var listId = this.listId;
		var cek_storage = [];
		if(listId.length>0){
			cek_storage = alasql("SELECT * FROM ? WHERE id = '"+id_storage+"'",[listId]);
		}

		if( cek_storage.length>=0){
			var table = this.storageTable[id_storage];
			if(typeof table[0]!="undefined"){
				var row = {};
				var total_add=0;
				var total_row=0;
				$.each(table[0],function(column, value) {
					if( typeof data[column]!="undefined"){
						row[column] = data[column];
						total_add++;
					}else{
						row[column] = '';
					}
					total_row++;
				});
				if(total_row>=total_add ){
					table.push(row);
				}
			}else{
				table.push(data);
			}
			this.storageTable[id_storage] = table;
			this.setLocalStorage();
		}else{
			console.error('tabel "'+id_storage+'" Tidak Ditemukan!');
		}
	}

	getTable(id_storage, select='*',condition=''){
		var result = [];
		var listId = this.listId;
		var cek_storage = [];
		if(listId.length>0){
			cek_storage = alasql("SELECT * FROM ? WHERE id = '"+id_storage+"'",[listId]);
		}
		var sql = "SELECT "+select+" FROM ? "+condition;
		if( cek_storage.length>0 && cek_storage[0].type_storage=='table'){
			var table = this.storageTable[id_storage];
			result = alasql(sql, [table]);
		}
		return result;
	}

	clearStorage(){
		localStorage.removeItem("variable");
		localStorage.removeItem("table");
	}
}