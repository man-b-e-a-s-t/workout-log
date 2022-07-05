import { Component, OnInit } from '@angular/core';
import { Router } from "@angular/router"
import { LoadingService } from '../services/loading/loading.service';
import { Workout } from './workout.interface';
import { WorkoutService } from './workout.service';

@Component({
  selector: 'app-workouts',
  templateUrl: './workouts.component.html',
  styleUrls: ['./workouts.component.scss']
})

export class WorkoutsComponent implements OnInit {

  workouts: Workout[] = [];
  loaded: boolean = false;
  displayedColumns: string[] = ['name', 'workoutDate', 'actions'];

  constructor(private router: Router, private loadingService: LoadingService, private workoutService: WorkoutService) { }

  ngOnInit(): void {
    this.loadingService.isLoading();
    this.workouts = [];
    this.workoutService.getWorkouts().subscribe((workouts: Workout[]) => {
      this.loadingService.isLoading(false);
      this.loaded = true;
      this.workouts = workouts.map(workout => new Workout(workout))
      .sort((a, b) => a.workoutDate < b.workoutDate ? 1 : -1);
      console.log(this.workouts)
    });
  }

  copyWorkout(id: string) {
    window.event?.stopPropagation();
    this.loadingService.isLoading();

    this.workoutService.copyWorkout(id).subscribe((response: any) => {
      this.loadingService.isLoading(false);
      console.log(response);
      if (response.newWorkoutId) {
        this.router.navigate(['/workouts', response.newWorkoutId]);
      }
    });
  }

  deleteWorkout(id: number) {
    window.event?.stopPropagation();
    // this.loadingService.isLoading();

    // this.workoutService.deleteWorkout(id).subscribe((response: any) => {
    //   this.loadingService.isLoading(false);
    //   console.log(response);
    //   if (response.newWorkoutId) {
        this.workouts = this.workouts.filter(x => x.id != id);
        // this.router.navigate(['/workouts', response.newWorkoutId]);
    //   }
    // });
  }

}
