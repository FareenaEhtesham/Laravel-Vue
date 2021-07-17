export default class Gate{


    constructor(user){
        this.user = user;
    }

    isAdmin(){
        return this.user.type === "admin"
    }

    isAuthor(){
        return this.user.type === "author"
    }

    isUser(){
        return this.user.type === "user"
    }
    isAdminAuthor(){
        if(this.user.type === "admin" || this.user.type === "author")
        return true;
    }
}