import { Component, OnInit } from '@angular/core';

@Component({
  selector: '[app-servers]',

  template: `
  <app-server>
  </app-server>`,

  style: [`
    h3{
      color: dodgerblue;
    }
    `]
})
export class ServersComponent implements OnInit {

  constructor() { }

  ngOnInit() {
  }

}
