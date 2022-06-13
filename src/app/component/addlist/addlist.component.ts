import { Component, OnInit, Output, EventEmitter } from '@angular/core';

@Component({
  selector: 'app-addlist',
  templateUrl: './addlist.component.html',
  styleUrls: ['./addlist.component.css']
})
export class AddlistComponent implements OnInit {

  constructor() { }

@ Output() storeListEvent = new EventEmitter<{title:any,items:any}>();

  ngOnInit(): void {
  }


  sendList(listTitle:any, listItem:any)
  {
    this.storeListEvent.emit({title:listTitle, items: listItem});
  }

}
