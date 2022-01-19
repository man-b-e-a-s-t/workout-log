import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

import { Exercise, ExerciseType } from './exercise.interface';

import { environment } from '../../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class ExerciseService {

  private exerciseTypes: any;

  constructor(private http: HttpClient) { }

  getExercises(): Observable<Exercise[]> {
    return this.http.get<Exercise[]>(`${environment.api}/exercise/read.php`);
  }

  getExercise(exerciseId: string): Observable<Exercise> {
    return this.http.get<Exercise>(`${environment.api}/exercise/read.php?id=${exerciseId}`);
  }

  getExerciseTypes(): Observable<ExerciseType[]> {
    if (this.exerciseTypes != null) {
      return this.exerciseTypes;
    }
    this.exerciseTypes = this.http.get<ExerciseType[]>(`${environment.api}/exerciseType/read.php`);
    return this.exerciseTypes;
  }
}
