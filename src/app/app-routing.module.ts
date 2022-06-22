import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule, Routes } from '@angular/router';
import { AppComponent } from './app.component';
import { AddlistComponent } from './component/addlist/addlist.component';
import { EditlistComponent } from './component/editlist/editlist.component';
import { ShowlistComponent } from './component/showlist/showlist.component';

const routes: Routes = [
  {path: '', 
  component: ShowlistComponent},
  {path: 'add',
  component: AddlistComponent},
  {path: 'edit/:id',
  component: EditlistComponent},
];

@NgModule({
  imports: [
    CommonModule,
    RouterModule.forRoot(routes)
  ],
  exports: [RouterModule]
})
export class AppRoutingModule { }
// export const routingComponents = [AppComponent]
