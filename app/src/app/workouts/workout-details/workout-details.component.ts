import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { LoadingService } from '../../services/loading/loading.service';
import { Workout } from '../workout.interface';
import { WorkoutService } from '../workout.service';

@Component({
  selector: 'app-workout-details',
  templateUrl: './workout-details.component.html',
  styleUrls: ['./workout-details.component.scss']
})
export class WorkoutDetailsComponent implements OnInit {

  workout: Workout | undefined;
  loaded: boolean = false;

  constructor(private loadingService: LoadingService, private workoutService: WorkoutService, private route: ActivatedRoute) {
    this.route.params.subscribe(params => {
      this.loadWorkout(params['workoutId']);
    });
  }

  ngOnInit(): void {
  }

  loadWorkout(workoutId: string) {
    if (workoutId != `new`) {
      this.loadingService.isLoading();
      this.workoutService.getWorkout(workoutId).subscribe((workout: Workout) => {
        this.loadingService.isLoading(false);
        this.loaded = true;
        this.workout = new Workout(workout);
      });
    }

  }

}
