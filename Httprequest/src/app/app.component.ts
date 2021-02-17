import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'Httprequest';
  coms: any;
  onDeleteCms: any;


  constructor() {
  }


  // tslint:disable-next-line:typedef
  onSubmit(value: any) {
 }
}
