import { Component, OnInit } from '@angular/core';
import { LoadingService } from '../services/loading/loading.service';
import { Workout } from './workout.interface';
import { WorkoutService } from './workout.service';

@Component({
  selector: 'app-workouts',
  templateUrl: './workouts.component.html',
  styleUrls: ['./workouts.component.scss']
})

// export interface PeriodicElement {
//   name: string;
//   position: number;
//   weight: number;
//   symbol: string;
// }

// const ELEMENT_DATA =

export class WorkoutsComponent implements OnInit {

  workouts: Workout[] = [];
  loaded: boolean = false;
  displayedColumns: string[] = ['name', 'workoutDate'];

  constructor(private loadingService: LoadingService, private workoutService: WorkoutService) { }

  ngOnInit(): void {
    this.loadingService.isLoading();
    this.workouts = [];
    this.workoutService.getWorkouts().subscribe((workouts: Workout[]) => {
      this.loadingService.isLoading(false);
      this.loaded = true;
      console.log(workouts)
      this.workouts = workouts.map(workout => new Workout(workout));
    });
  }

}
