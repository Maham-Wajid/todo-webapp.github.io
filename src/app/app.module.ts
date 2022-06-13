import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { HeaderComponent } from './component/header/header.component';
import { AddlistComponent } from './component/addlist/addlist.component';
import { ShowlistComponent } from './component/showlist/showlist.component';


@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    AddlistComponent,
    ShowlistComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
