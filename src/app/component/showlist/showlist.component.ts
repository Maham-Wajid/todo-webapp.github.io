import { Component, OnInit} from '@angular/core';
import { NotesService } from 'src/app/notes.service';

@Component({
  selector: 'app-showlist',
  templateUrl: './showlist.component.html',
  styleUrls: ['./showlist.component.css']
})
export class ShowlistComponent implements OnInit {
  notes: any;

  constructor( private noteService: NotesService) { }

  // @ Input() title = null;
  // @ Input() item:any = [];

  ngOnInit(): void {
    this.noteService.getNotes().subscribe(
      (result:any) => {
        // console.log(result);
        this.notes = result.data;
      }
    )
  }

  removeTask(note:any)
  {
    // this.item.splice(id,1);

    this.noteService.deleteNote(note.id).subscribe(data=>{
      this.notes = this.notes.filter((u:any) => u!== note);
    })
  }

}
