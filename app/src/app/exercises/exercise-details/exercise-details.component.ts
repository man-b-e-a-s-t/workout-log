import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { LoadingService } from '../../services/loading/loading.service';
import { Exercise, ExerciseType } from '../exercise.interface';
import { ExerciseService } from '../exercise.service';

@Component({
  selector: 'app-exercise-details',
  templateUrl: './exercise-details.component.html',
  styleUrls: ['./exercise-details.component.scss']
})
export class ExerciseDetailsComponent implements OnInit {

  exercise: Exercise | undefined;
  loaded: boolean = false;
  exerciseTypes: ExerciseType[] = [
    { id: 1, name: "Lower Body" },
    { id: 2, name: "Upper Body" },
    { id: 3, name: "Core" }
  ];

  constructor(private loadingService: LoadingService, private exerciseService: ExerciseService, private route: ActivatedRoute) {
    this.route.params.subscribe(params => {
      this.loadExercise(params['id']);
    });
  }

  ngOnInit(): void {
  }

  loadExercise(id: string) {
    if (id != `new`) {
      this.loadingService.isLoading();
      this.exerciseService.getExerciseTypes().subscribe((exerciseTypes: ExerciseType[]) => {
        this.exerciseService.getExercise(id).subscribe((exercise: Exercise) => {
          this.loadingService.isLoading(false);
          this.loaded = true;
          this.exercise = new Exercise(exerciseTypes, exercise);
        });
      });
    }

  }

}
