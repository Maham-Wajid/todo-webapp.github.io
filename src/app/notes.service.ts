import { Injectable } from '@angular/core';
import { HttpClientModule } from '@angular/common/http';
import {HttpClient, HttpParams, HttpErrorResponse} from '@angular/common/http';
import { Todo } from './Todo';

@Injectable({
  providedIn: 'root'
})
export class NotesService {

  constructor(private http: HttpClient) { }

  baseURL : string = 'http://localhost/api/notes_api/';

  getNotes(){
    return this.http.get<Todo[]>(this.baseURL+'view.php');
  }

  getSingleNote(id:any){
    return this.http.get<Todo[]>(this.baseURL+'view.php?id='+id);
  }

  deleteNote(id:any){
    return this.http.delete(this.baseURL+'delete.php?id='+ id);
  }

  createNote(task: any){
    console.log(task);
    return this.http.post(this.baseURL+'insert.php',task);
  }

  UpdateNote(task:any){
    return this.http.put(this.baseURL+'update.php',task);
  }

}
