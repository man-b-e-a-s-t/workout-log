import { Component, OnInit } from '@angular/core';
import { LoadingService } from '../services/loading/loading.service';
import { Exercise, ExerciseType } from './exercise.interface';
import { ExerciseService } from './exercise.service';

@Component({
  selector: 'app-exercises',
  templateUrl: './exercises.component.html',
  styleUrls: ['./exercises.component.scss']
})
export class ExercisesComponent implements OnInit {

  exercises: Exercise[] = [];
  loaded: boolean = false;
  displayedColumns: string[] = ['name', 'exerciseTypeId', 'notes'];

  constructor(private loadingService: LoadingService, private exerciseService: ExerciseService) { }

  ngOnInit(): void {
    this.loadingService.isLoading();
    this.exercises = [];
    this.exerciseService.getExerciseTypes().subscribe((exerciseTypes: ExerciseType[]) => {
      this.exerciseService.getExercises().subscribe((exercises: Exercise[]) => {
        this.loadingService.isLoading(false);
        this.loaded = true;
        this.exercises = exercises.map(exercise => new Exercise(exerciseTypes, exercise))
          .sort((a, b) => a.name < b.name ? -1 : 1);;
      });
    });
  }

}
