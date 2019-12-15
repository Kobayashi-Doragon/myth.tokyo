function check(){
    alert("※入力されていない内容が複数あります。");
    var error_count=0;
    var error_message="";
    if (form.name.value == ""){
        //条件に一致する場合(メールアドレスが空の場合)
        error_count++;
        error_message="※名前を入力してください";    
    }
    if (form.email.value == ""){
        error_count++;
        error_message="※メールアドレスを入力してください";    
    }
    if (form.content.value == ""){
        error_count++;
        error_message="※お問い合わせ内容を入力してください";    
    }

    if(error_count==0){
        return true;
    }
    else if(error_count>1){
        alert(error_message);
        return false;
    }
    else{
        alert("※入力されていない内容が複数あります。");
        return false; 
    }
}