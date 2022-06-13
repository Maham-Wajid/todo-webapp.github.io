import { Component, OnInit, Input, Output } from '@angular/core';

@Component({
  selector: 'app-showlist',
  templateUrl: './showlist.component.html',
  styleUrls: ['./showlist.component.css']
})
export class ShowlistComponent implements OnInit {

  constructor() { }

  // @ Input() title = null;
  @ Input() item:any = [];

  ngOnInit(): void {
  }

  removeTask(id:number)
  {
    this.item.splice(id,1);
  }

}
