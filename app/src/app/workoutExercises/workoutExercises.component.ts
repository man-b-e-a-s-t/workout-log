import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { LoadingService } from '../services/loading/loading.service';
import { WorkoutExercise } from './workoutExercise.interface';
import { WorkoutExerciseService } from './workoutExercise.service';

@Component({
  selector: 'app-workout-exercises',
  templateUrl: './workoutExercises.component.html',
  styleUrls: ['./workoutExercises.component.scss']
})

export class WorkoutExercisesComponent implements OnInit {

  workoutExercises: WorkoutExercise[] = [];
  loaded: boolean = false;
  displayedColumns: string[] = ['stepNumber', 'weightGoal', 'timeGoal', 'setGoal', 'repGoal', 'notes'];

  constructor(private loadingService: LoadingService, private workoutExerciseService: WorkoutExerciseService, private route: ActivatedRoute) {
    this.route.params.subscribe(params => {
      this.loadWorkoutExercises(params['id']);
    });
  }

  ngOnInit(): void {
  }

  loadWorkoutExercises(workoutId: number): void {
    this.loadingService.isLoading();
    this.workoutExercises = [];
    this.workoutExerciseService.getWorkoutExercisesByWorkout(workoutId).subscribe((workoutExercises: WorkoutExercise[]) => {
      this.loadingService.isLoading(false);
      this.loaded = true;
      this.workoutExercises = workoutExercises.map(workoutExercise => new WorkoutExercise(workoutExercise));
    });
  }

}
