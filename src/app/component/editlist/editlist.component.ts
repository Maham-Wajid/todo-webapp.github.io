import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { NotesService } from 'src/app/notes.service';

@Component({
  selector: 'app-editlist',
  templateUrl: './editlist.component.html',
  styleUrls: ['./editlist.component.css']
})
export class EditlistComponent implements OnInit {
  addForm:any;
  task_id:any;

  constructor(
    private formBuilder: FormBuilder, 
    private router: Router, 
    private noteService: NotesService,
    private url:ActivatedRoute
  ) 
  { 
    this.addForm = this.formBuilder.group({
      id:[],
      title: ['', Validators.required],
      description: ['', Validators.required],
    })
  }

  ngOnInit(): void {
    this.task_id = this.url.snapshot.params['id'];
    // console.log(this.task_id);
    if(this.task_id > 0){
      this.noteService.getSingleNote(this.task_id).subscribe(
        (data:any) => {
          // console.log(data.data);
          this.addForm.patchValue(data.data);
        }
      );
    }
  }

  onUpdate(){
    this.noteService.UpdateNote(this.addForm.value).subscribe(
      (data:any) => {
        // console.log(data);
        this.router.navigate(['']);
      }
    );
  }

}
