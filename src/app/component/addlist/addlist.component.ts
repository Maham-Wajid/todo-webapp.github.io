import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { NotesService } from 'src/app/notes.service';

@Component({
  selector: 'app-addlist',
  templateUrl: './addlist.component.html',
  styleUrls: ['./addlist.component.css']
})
export class AddlistComponent implements OnInit {
  addForm:any;

  constructor( 
    private formBuilder: FormBuilder, 
    private router: Router, 
    private noteService: NotesService 
    ) 
    {

    this.addForm = this.formBuilder.group({
      title: ['', Validators.required],
      description: ['', Validators.required],
    })

   }

// @ Output() storeListEvent = new EventEmitter<{title:any,items:any}>();

  ngOnInit(): void {
  }

  reloadCurrentPage() {
    window.location.reload();
  }

  onSubmit(){
    this.noteService.createNote(this.addForm.value).subscribe(
      (data:any) => {
        this.reloadCurrentPage();
        // this.router.navigate(['']);
      }
    );
  }

}
